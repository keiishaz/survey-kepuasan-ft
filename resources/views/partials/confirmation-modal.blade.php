<!-- Universal Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-30 transition-opacity backdrop-blur-sm" aria-hidden="true"></div>
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md">
            <div class="bg-white px-6 pt-6 pb-4 sm:pb-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-12 sm:w-12">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="mt-4 text-center sm:mt-0 sm:text-left w-full">
                        <h3 class="text-lg font-bold leading-6 text-gray-900" id="modalTitle">Konfirmasi Tindakan</h3>
                        <div class="mt-3">
                            <p class="text-sm text-gray-600" id="modalMessage">Apakah Anda yakin ingin melakukan tindakan ini?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 bg-gray-50 px-6 py-4 sm:py-5">
                <button type="button" id="cancelButton" class="mt-2 sm:mt-0 px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium text-sm hover:bg-gray-100 transition-colors sm:px-4">
                    Batal
                </button>
                <button type="button" id="confirmButton" class="px-5 py-2.5 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white font-medium text-sm hover:from-red-600 hover:to-red-700 transition-all shadow-sm sm:px-4">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Universal confirmation function
    function showConfirmation(title, message, onConfirm) {
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalMessage').innerHTML = message;
        document.getElementById('confirmationModal').classList.remove('hidden');

        // Apply overflow hidden to prevent background scrolling
        document.body.classList.add('overflow-hidden');

        // Set the callback function
        window.currentConfirmCallback = onConfirm;
    }

    function hideConfirmation() {
        document.getElementById('confirmationModal').classList.add('hidden');

        // Remove overflow hidden
        document.body.classList.remove('overflow-hidden');
    }

    // Event listeners for confirmation modal
    document.getElementById('confirmButton').addEventListener('click', function() {
        if (typeof window.currentConfirmCallback === 'function') {
            window.currentConfirmCallback();
        }
        hideConfirmation();
    });

    document.getElementById('cancelButton').addEventListener('click', hideConfirmation);

    // Close modal when clicking outside the modal content
    document.getElementById('confirmationModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideConfirmation();
        }
    });

    // Enhanced delete functions using universal modal
    function showDeleteConfirmation(id, name, deleteUrl, additionalInfo = null) {
        let message = `Apakah Anda yakin ingin menghapus <span class="font-semibold">${name}</span>? Tindakan ini tidak dapat dibatalkan.`;

        // Add additional info if provided (e.g., related form count for categories)
        if (additionalInfo && additionalInfo.formCount > 0) {
            message = `Apakah Anda yakin ingin menghapus <span class="font-semibold">${name}</span>?<br><br><div class="mt-2 bg-yellow-50 border border-yellow-200 rounded-md p-2 text-xs text-yellow-700">Peringatan: Kategori ini masih digunakan oleh <span class="font-semibold">${additionalInfo.formCount}</span> form. Jika kategori dihapus, form-form tersebut tidak akan memiliki kategori.</div>`;
        }

        showConfirmation(
            "Konfirmasi Penghapusan",
            message,
            function() {
                // Create and submit a form for deletion
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                form.style.display = 'none';

                const token = document.createElement('input');
                token.type = 'hidden';
                token.name = '_token';
                token.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';

                form.appendChild(token);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        );
    }

    // Enhanced save/update function using universal modal
    function showSaveConfirmation(message, onConfirm) {
        showConfirmation(
            "Konfirmasi Penyimpanan",
            message,
            onConfirm
        );
    }

    // Function to add confirmation to form submission
    function addFormConfirmation(formSelector, message = "Apakah Anda yakin ingin menyimpan perubahan?") {
        const form = document.querySelector(formSelector);
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                showSaveConfirmation(
                    message,
                    function() {
                        // Submit the form after confirmation
                        form.submit();
                    }
                );
            });
        }
    }

    // Set up all delete buttons on the page
    document.addEventListener('DOMContentLoaded', function() {
        // Add CSRF token meta tag if not present
        if (!document.querySelector('meta[name="csrf-token"]')) {
            const meta = document.createElement('meta');
            meta.name = 'csrf-token';
            meta.content = document.querySelector('input[name="_token"]').value;
            document.head.appendChild(meta);
        }

        // Initialize all delete buttons with confirmation
        const deleteButtons = document.querySelectorAll('[data-delete-url]');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.getAttribute('data-delete-url');
                const name = this.getAttribute('data-item-name') || 'item';
                const id = this.getAttribute('data-item-id');

                // Check for additional info like form count for categories
                const formCount = this.getAttribute('data-form-count');
                const additionalInfo = formCount ? { formCount: parseInt(formCount) } : null;

                showDeleteConfirmation(id, name, url, additionalInfo);
            });
        });
    });
</script>