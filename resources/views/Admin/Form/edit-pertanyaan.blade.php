<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPULAS - Edit Pertanyaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-blue': '#1E3A8A',
                        'medium-blue': '#3B82F6'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f7fa;
        }
        main {
            max-width: 100%;
        }
        .card {
            background: white;
            border-radius: 8px;
            border: 1px solid #e0e7ff;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .card.compact {
            padding: 20px 24px;
        }
        .section-header {
            font-size: 18px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 24px;
        }
        .field-section {
            margin-bottom: 28px;
        }
        .field-section:last-child {
            margin-bottom: 0;
        }
        .field-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .field-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
            transition: all 0.2s;
        }
        .field-input:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        .identity-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
        }
        .identity-row:last-child {
            margin-bottom: 0;
        }
        .identity-input {
            flex: 1;
        }
        .identity-row .btn {
            flex-shrink: 0;
        }
        .identity-toggle-container {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 120px;
            width: 120px;
            justify-content: flex-end;
        }
        .identity-toggle-label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            white-space: nowrap;
            min-width: 0;
            text-align: right;
        }
        .identity-toggle {
            width: 48px;
            height: 26px;
            background: #cbd5e1;
            border-radius: 13px;
            cursor: pointer;
            position: relative;
            transition: background 0.3s;
            border: none;
        }
        .identity-toggle.active {
            background: #10b981;
        }
        .identity-toggle-dot {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            transition: left 0.3s;
        }
        .identity-toggle.active .identity-toggle-dot {
            left: 25px;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }
        .btn-small {
            padding: 6px 12px;
            font-size: 13px;
        }
        .btn-primary {
            background: #3B82F6;
            color: white;
        }
        .btn-primary:hover {
            background: #1E3A8A;
        }
        .btn-secondary {
            background: #f1f5f9;
            color: #1e293b;
            border: 1px solid #cbd5e1;
        }
        .btn-secondary:hover {
            background: #e2e8f0;
        }
        .btn-danger {
            background: #fee2e2;
            color: #b91c1c;
        }
        .btn-danger:hover {
            background: #fecaca;
        }
        .btn-ghost {
            background: transparent;
            color: #3B82F6;
            border: 1px solid #bfdbfe;
        }
        .btn-ghost:hover {
            background: #eff6ff;
        }
        .scale-section {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 16px;
            margin-bottom: 16px;
        }
        .scale-row {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }
        .scale-label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            min-width: 90px;
        }
        .scale-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
            flex: 1;
            min-width: 200px;
        }
        .scale-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #cbd5e1;
            background: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            transition: all 0.2s;
        }
        .scale-btn:hover {
            border-color: #3B82F6;
            color: #3B82F6;
        }
        .scale-btn.active {
            background: #3B82F6;
            border-color: #3B82F6;
            color: white;
        }
        .toggle-container {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 120px;
        }
        .toggle-label {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
        }
        .toggle {
            width: 48px;
            height: 26px;
            background: #cbd5e1;
            border-radius: 13px;
            cursor: pointer;
            position: relative;
            transition: background 0.3s;
            border: none;
        }
        .toggle.active {
            background: #10b981;
        }
        .toggle-dot {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            background: white;
            border-radius: 50%;
            transition: left 0.3s;
        }
        .toggle.active .toggle-dot {
            left: 25px;
        }
        .question-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 20px;
        }
        .question-card .field-section {
            margin-bottom: 20px;
        }
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 20px 0;
        }
        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .button-group.footer {
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid #e0e7ff;
        }
        .add-button {
            width: 100%;
            padding: 14px;
            border: 2px dashed #cbd5e1;
            background: transparent;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s;
        }
        .add-button:hover {
            border-color: #3B82F6;
            color: #3B82F6;
            background: #eff6ff;
        }
        .textarea {
            resize: vertical;
            min-height: 80px;
        }
        .row-actions {
            display: flex;
            gap: 8px;
        }
        @media (max-width: 1024px) {
            .card {
                padding: 24px;
            }
        }
        @media (max-width: 768px) {
            .card {
                padding: 18px;
            }
            .section-header {
                font-size: 16px;
            }
            .field-label {
                font-size: 13px;
            }
            .field-input {
                padding: 8px 12px;
                font-size: 13px;
            }
            .btn {
                padding: 7px 14px;
                font-size: 13px;
            }
            .btn-small {
                padding: 5px 10px;
                font-size: 12px;
            }
            .scale-row {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }
            .scale-label {
                min-width: unset;
            }
            .scale-buttons {
                min-width: unset;
                flex: unset;
            }
            .identity-row {
                flex-wrap: wrap;
            }
            .identity-toggle-container {
                order: 3;
                width: 100%;
                margin-top: 8px;
                justify-content: flex-end;
            }
            .identity-row .btn {
                margin-left: 0;
                margin-top: 8px;
            }
            .toggle-container {
                min-width: unset;
                width: 100%;
                justify-content: space-between;
            }
            .button-group {
                flex-direction: column;
            }
            .button-group > * {
                width: 100%;
            }
            .question-card {
                padding: 16px;
            }
        }
        @media (max-width: 480px) {
            .card {
                padding: 14px;
            }
            .section-header {
                font-size: 15px;
                margin-bottom: 12px;
            }
            .field-section {
                margin-bottom: 14px;
            }
            .scale-btn {
                width: 36px;
                height: 36px;
                font-size: 12px;
            }
            .divider {
                margin: 14px 0;
            }
            .button-group.footer {
                margin-top: 16px;
                padding-top: 16px;
            }
        }
    </style>
</head>
<body class="min-h-screen">
    <div class="flex min-h-screen">
        @include('Admin.navbar')

        <main class="flex-1 lg:ml-64">
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="px-6 lg:px-8 py-4">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <!-- Mobile Menu Button -->
                            <button class="lg:hidden mr-3 bg-white p-2 rounded-lg shadow-sm border border-gray-200" id="sidebar-toggle">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                            <div>
                                <h1 class="text-xl font-semibold text-gray-800">Edit Pertanyaan</h1>
                                <p class="text-sm text-gray-500 mt-0.5">Form {{ $form->nama ?? 'Tidak Ditemukan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-6 lg:p-8">

                <!-- Identitas Section -->
                <div class="card">
                    <h2 class="section-header">Identitas Responden</h2>
                    <p class="text-13px text-gray-600 mb-6">Tambahkan informasi dasar yang ingin Anda kumpulkan dari responden</p>

                    <div id="identitasContainer" class="mb-6">
                        <!-- Generated items -->
                    </div>

                    <button onclick="addIdentitasItem()" class="btn btn-primary" id="addIdentitasBtn">
                        + Tambah Identitas
                    </button>
                </div>

                <!-- Questions Section -->
                <div id="questionsContainer">
                    <!-- Generated sections -->
                </div>

                <!-- Add Section -->
                <div class="card">
                    <button onclick="addSection()" class="add-button">
                        + Tambah Bagian Pertanyaan
                    </button>
                </div>

                <!-- Action Buttons -->
                <div class="button-group footer">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" onclick="confirmSubmitForm()">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </main>

        <!-- Hidden form for submission -->
        <form id="editPertanyaanForm" method="POST" action="{{ route('forms.update-pertanyaan', $form->id_kuesioner) }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="identitas_data" id="identitasDataInput">
            <input type="hidden" name="questions_data" id="questionsDataInput">
        </form>
    </div>

    <script>
        // Load data from backend
        const backendData = {
            identitas: [
                @if(isset($identitas['atribut1']) && $identitas['atribut1'])
                { id: 1, label: "{{ addslashes($identitas['atribut1']) }}", required: {{ $identitas['wajib1'] ? 'true' : 'false' }}, existing: true },
                @endif
                @if(isset($identitas['atribut2']) && $identitas['atribut2'])
                { id: 2, label: "{{ addslashes($identitas['atribut2']) }}", required: {{ $identitas['wajib2'] ? 'true' : 'false' }}, existing: true },
                @endif
                @if(isset($identitas['atribut3']) && $identitas['atribut3'])
                { id: 3, label: "{{ addslashes($identitas['atribut3']) }}", required: {{ $identitas['wajib3'] ? 'true' : 'false' }}, existing: true },
                @endif
                @if(isset($identitas['atribut4']) && $identitas['atribut4'])
                { id: 4, label: "{{ addslashes($identitas['atribut4']) }}", required: {{ $identitas['wajib4'] ? 'true' : 'false' }}, existing: true },
                @endif
                @if(isset($identitas['atribut5']) && $identitas['atribut5'])
                { id: 5, label: "{{ addslashes($identitas['atribut5']) }}", required: {{ $identitas['wajib5'] ? 'true' : 'false' }}, existing: true },
                @endif
            ],
            sections: [
                @if(isset($sections) && $sections->count() > 0)
                    @foreach($sections as $section)
                {
                    id: {{ $section->id_section }},
                    title: "{{ addslashes($section->judul) }}",
                    questions: [
                        @foreach($section->pertanyaan as $question)
                        {
                            id: {{ $question->id_pertanyaan }},
                            text: "{{ addslashes($question->teks) }}",
                            required: {{ $question->status_aktif ? 'true' : 'false' }},
                            scale: 3, // Default scale, adjust as needed
                            existing: true
                        }@if(!$loop->last),
                        @endif
                        @endforeach
                    ]
                }@if(!$loop->last),
                @endif
                @endforeach
                @else
                {
                    id: 1,
                    title: 'Pertanyaan Umum',
                    questions: [
                        @if(isset($pertanyaan) && $pertanyaan->count() > 0)
                            @foreach($pertanyaan as $question)
                        {
                            id: {{ $question->id_pertanyaan }},
                            text: "{{ addslashes($question->teks) }}",
                            required: {{ $question->status_aktif ? 'true' : 'false' }},
                            scale: 3, // Default scale, adjust as needed
                            existing: true
                        }@if(!$loop->last),
                        @endif
                            @endforeach
                        @else
                        {
                            id: 1,
                            text: 'Pertanyaan baru',
                            required: false,
                            scale: 3,
                            existing: false
                        }
                        @endif
                    ]
                }
                @endif
            ]
        };

        // Existing identitas options that are saved in the system
        const systemIdentitasOptions = [
            'Nama Lengkap', 'Email', 'Program Studi', 'Angkatan', 'Status',
            'NIM', 'Nama Dosen', 'Mata Kuliah', 'Fakultas', 'Jenis Kelamin',
            'Semester', 'IPK', 'Nama Orang Tua', 'Pekerjaan Orang Tua', 'Penghasilan Orang Tua'
        ];

        let nextIdentitasId = backendData.identitas.length > 0 ? Math.max(...backendData.identitas.map(i => i.id)) + 1 : 1;
        let nextSectionId = backendData.sections.length > 0 ? Math.max(...backendData.sections.map(s => s.id)) + 1 : 2;
        let nextQuestionId = 1;

        // Find the highest question ID to continue numbering correctly
        backendData.sections.forEach(section => {
            if (section.questions && section.questions.length > 0) {
                const maxQuestionId = Math.max(...section.questions.map(q => q.id));
                if (maxQuestionId > nextQuestionId) {
                    nextQuestionId = maxQuestionId + 1;
                }
            }
        });

        // Initialize current data
        let data = {
            identitas: backendData.identitas.length > 0 ? [...backendData.identitas] : [],
            sections: [...backendData.sections]
        };

        // If no identitas exist, add default ones
        if (data.identitas.length === 0) {
            data.identitas = [
                { id: 1, label: 'Nama Lengkap', existing: false },
                { id: 2, label: 'Email', existing: false },
                { id: 3, label: 'Program Studi', existing: false },
                { id: 4, label: 'Angkatan', existing: false },
                { id: 5, label: 'Status', existing: false }
            ];
            nextIdentitasId = 6;
        }

        function renderIdentitas() {
            const container = document.getElementById('identitasContainer');
            container.innerHTML = data.identitas.map((item, index) => `
                <div class="identity-row">
                    <div class="relative flex-1">
                        <input type="text" value="${item.label}" placeholder="Nama field identitas..."
                               class="field-input identity-input"
                               oninput="data.identitas[${index}].label = this.value"
                               id="identitas-${item.id}">
                        <div id="identitas-dropdown-${item.id}" class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg hidden">
                            <div class="p-2 border-b border-gray-200">
                                <input type="text" placeholder="Cari atribut..."
                                       class="field-input w-full text-sm text-gray-900"
                                       oninput="filterIdentitasOptions(${index}, this.value)">
                            </div>
                            <div class="max-h-60 overflow-y-auto">
                                ${systemIdentitasOptions.map(option => `
                                    <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer text-sm"
                                         onclick="selectIdentitasOption(${index}, '${option.replace(/'/g, "\\'")}')">
                                        ${option}
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    </div>

                    <div class="identity-toggle-container">
                        <span class="identity-toggle-label">${item.required ? 'Wajib' : 'Tidak Wajib'}</span>
                        <button type="button" class="identity-toggle ${item.required ? 'active' : ''}"
                               onclick="data.identitas[${index}].required = !data.identitas[${index}].required; renderIdentitas()">
                            <div class="identity-toggle-dot"></div>
                        </button>
                    </div>

                    <button type="button" onclick="toggleSelectIdentitas(${index})" class="btn btn-small btn-secondary ml-2">
                        Pilih
                    </button>

                    <button type="button" onclick="removeIdentitasItem(${index})" class="btn btn-small btn-danger ml-2">
                        Hapus
                    </button>
                </div>
            `).join('');

            // Hide dropdowns initially
            document.querySelectorAll('[id^="identitas-dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });

            // Add event listeners to handle clicks outside dropdowns
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.relative')) {
                    document.querySelectorAll('[id^="identitas-dropdown-"]').forEach(dropdown => {
                        dropdown.classList.add('hidden');
                    });
                }
            });

            // Update button state based on count
            updateIdentitasButtonState();
        }

        function toggleSelectIdentitas(index) {
            const dropdown = document.getElementById(`identitas-dropdown-${data.identitas[index].id}`);
            const isVisible = !dropdown.classList.contains('hidden');

            // Hide all dropdowns
            document.querySelectorAll('[id^="identitas-dropdown-"]').forEach(d => d.classList.add('hidden'));

            // Toggle current dropdown
            if (!isVisible) {
                dropdown.classList.remove('hidden');
            }
        }

        function filterIdentitasOptions(index, searchValue) {
            const dropdown = document.getElementById(`identitas-dropdown-${data.identitas[index].id}`);
            const items = dropdown.querySelectorAll('div:not(.p-2)');
            const filter = searchValue.toLowerCase();

            items.forEach(item => {
                const text = item.textContent.toLowerCase();
                if (text.includes(filter)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        }

        function selectIdentitasOption(index, option) {
            data.identitas[index].label = option;
            document.getElementById(`identitas-${data.identitas[index].id}`).value = option;
            document.getElementById(`identitas-dropdown-${data.identitas[index].id}`).classList.add('hidden');
        }

        function addIdentitasItem() {
            if (data.identitas.length < 5) {
                data.identitas.push({ id: nextIdentitasId++, label: `Field ${data.identitas.length + 1}`, existing: false });
                renderIdentitas();
            }
        }

        function removeIdentitasItem(index) {
            if (data.identitas.length > 1) { // Ensure at least 1 identitas
                data.identitas.splice(index, 1);
                renderIdentitas();
            } else {
                alert('Minimal harus ada 1 identitas');
            }
        }

        function updateIdentitasButtonState() {
            const addButton = document.getElementById('addIdentitasBtn');
            if (data.identitas.length >= 5) {
                addButton.style.display = 'none';
            } else {
                addButton.style.display = 'inline-block';
            }
        }

        function renderQuestions() {
            const container = document.getElementById('questionsContainer');
            container.innerHTML = data.sections.map((section, sectionIndex) => `
                <div class="card">
                    <div class="field-section">
                        <label class="field-label">Judul Bagian</label>
                        <input type="text" value="${section.title}" placeholder="Nama bagian pertanyaan..."
                               class="field-input"
                               oninput="data.sections[${sectionIndex}].title = this.value">
                    </div>

                    <div class="divider"></div>

                    ${section.questions.map((q, qIndex) => `
                        <div class="question-card">
                            <div class="field-section">
                                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                                    <label class="field-label">Pertanyaan ${qIndex + 1}</label>
                                    <button type="button" onclick="removeQuestion(${sectionIndex}, ${qIndex})" class="btn btn-small btn-danger">
                                        Hapus
                                    </button>
                                </div>
                                <textarea placeholder="Ketik pertanyaan di sini..."
                                         class="field-input textarea"
                                         oninput="data.sections[${sectionIndex}].questions[${qIndex}].text = this.value">${q.text}</textarea>
                            </div>
                        </div>
                    `).join('')}

                    <div class="button-group">
                        <button type="button" onclick="addQuestion(${sectionIndex})" class="btn btn-ghost">
                            + Tambah Pertanyaan
                        </button>
                        <button type="button" onclick="removeSection(${sectionIndex})" class="btn btn-danger">
                            Hapus Bagian
                        </button>
                    </div>
                </div>
            `).join('');

            updateSectionButtons();
        }

        function addQuestion(sectionIndex) {
            data.sections[sectionIndex].questions.push({
                id: nextQuestionId++,
                text: 'Pertanyaan baru',
                required: false,
                scale: 3,
                existing: false
            });
            renderQuestions();
        }

        function removeQuestion(sectionIndex, questionIndex) {
            showConfirmation(
                "Konfirmasi Penghapusan",
                "Apakah Anda yakin ingin menghapus pertanyaan ini?",
                function() {
                    data.sections[sectionIndex].questions.splice(questionIndex, 1);
                    renderQuestions();
                }
            );
        }

        function addSection() {
            data.sections.push({
                id: nextSectionId++,
                title: `Bagian ${data.sections.length}`,
                questions: [
                    { id: nextQuestionId++, text: 'Pertanyaan baru', required: false, scale: 3, existing: false }
                ]
            });
            renderQuestions();
        }

        function removeSection(sectionIndex) {
            showConfirmation(
                "Konfirmasi Penghapusan",
                "Apakah Anda yakin ingin menghapus bagian dan semua pertanyaannya?",
                function() {
                    data.sections.splice(sectionIndex, 1);
                    renderQuestions();
                }
            );
        }

        function updateSectionButtons() {
            // Add logic to update section buttons if needed
        }

        function submitForm() {
            // Prepare identitas data
            const identitasData = {
                atribut1: data.identitas[0] ? data.identitas[0].label : null,
                atribut2: data.identitas[1] ? data.identitas[1].label : null,
               atribut3: data.identitas[2] ? data.identitas[2].label : null,
                atribut4: data.identitas[3] ? data.identitas[3].label : null,
                atribut5: data.identitas[4] ? data.identitas[4].label : null,
                wajib1: data.identitas[0] ? data.identitas[0].required : null,
                wajib2: data.identitas[1] ? data.identitas[1].required : null,
                wajib3: data.identitas[2] ? data.identitas[2].required : null,
                wajib4: data.identitas[3] ? data.identitas[3].required : null,
                wajib5: data.identitas[4] ? data.identitas[4].required : null,
            };

            // Prepare questions data with proper section structure
            const questionsData = {
                sections: []
            };

            data.sections.forEach(section => {
                const sectionData = {
                    title: section.title,
                    questions: []
                };

                section.questions.forEach(question => {
                    sectionData.questions.push({
                        id: question.id || null, // Use null if not set (for new questions)
                        text: question.text,
                        required: question.required,
                        existing: question.existing
                    });
                });

                questionsData.sections.push(sectionData);
            });

            // Set the hidden form fields
            document.getElementById('identitasDataInput').value = JSON.stringify(identitasData);
            document.getElementById('questionsDataInput').value = JSON.stringify(questionsData);

            // Submit the form
            document.getElementById('editPertanyaanForm').submit();
        }

        function confirmSubmitForm() {
            showSaveConfirmation(
                "Apakah Anda yakin ingin menyimpan perubahan pertanyaan? Perubahan akan diterapkan ke form.",
                function() {
                    submitForm();
                }
            );
        }

        // Initial render
        renderIdentitas();
        renderQuestions();
    </script>

    <script>
        // Mobile Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('-translate-x-full');
                sidebar.classList.toggle('translate-x-0');

                const icon = this.querySelector('svg');
                if (sidebar.classList.contains('-translate-x-full')) {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                } else {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                }
            });

            document.addEventListener('click', function(event) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth < 1024) {
                    sidebar.classList.add('-translate-x-full');
                    const icon = sidebarToggle.querySelector('svg');
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
                }
            });
        }

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        if (window.innerWidth < 1024) {
            sidebar.classList.add('-translate-x-full');
        }
    </script>

    @include('partials.confirmation-modal')
</body>
</html>