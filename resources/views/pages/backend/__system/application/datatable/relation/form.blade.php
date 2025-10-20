@push('head')
<style>
    .custom-select-wrapper {
        position: relative;
    }

    .custom-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: #ffffff;
        border: 1px solid rgb(228 231 239);
        border-radius: 0.5rem;
        box-shadow: 0 0 50px 0 rgb(82 63 105 / 0.15);
        margin-top: 0.25rem;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
    }

    .custom-dropdown.hidden {
        display: none;
    }

    .custom-dropdown-item {
        padding: 0.5rem 1rem;
        cursor: pointer;
        font-size: 0.8125rem;
        font-weight: 400;
        transition: all 0.2s;
        color: rgb(24 28 50);
    }

    .custom-dropdown-item:hover {
        background-color: rgb(241 250 255);
        color: rgb(0 158 247);
    }

    .custom-dropdown-empty {
        padding: 0.5rem 1rem;
        color: rgb(161 165 183);
        font-size: 0.8125rem;
        text-align: center;
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .custom-dropdown {
            background: #1e1e2d;
            border-color: #2b2b40;
            box-shadow: 0 0 50px 0 rgb(0 0 0 / 0.3);
        }

        .custom-dropdown-item {
            color: #ffffff;
        }

        .custom-dropdown-item:hover {
            background-color: #2b2b40;
            color: rgb(0 158 247);
        }

        .custom-dropdown-empty {
            color: #6c6c80;
        }
    }

    /* Atau kalau pakai class-based dark mode (seperti Tailwind) */
    .dark .custom-dropdown {
        background: #1e1e2d;
        border-color: #2b2b40;
        box-shadow: 0 0 50px 0 rgb(0 0 0 / 0.3);
    }

    .dark .custom-dropdown-item {
        color: #ffffff;
    }

    .dark .custom-dropdown-item:hover {
        background-color: #2b2b40;
        color: rgb(0 158 247);
    }

    .dark .custom-dropdown-empty {
        color: #6c6c80;
    }

    /* Custom scrollbar untuk dark mode */
    .custom-dropdown::-webkit-scrollbar {
        width: 8px;
    }

    .custom-dropdown::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-dropdown::-webkit-scrollbar-thumb {
        background: rgb(161 165 183 / 0.3);
        border-radius: 4px;
    }

    .custom-dropdown::-webkit-scrollbar-thumb:hover {
        background: rgb(161 165 183 / 0.5);
    }

    .dark .custom-dropdown::-webkit-scrollbar-thumb {
        background: rgb(255 255 255 / 0.2);
    }

    .dark .custom-dropdown::-webkit-scrollbar-thumb:hover {
        background: rgb(255 255 255 / 0.3);
    }
</style>
@endpush

<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2">
            <a href="/dashboard/applications/datatables/generals/create" target="_blank" class="text-danger font-weight-bold"><u> Table General </u></a>
        </span>
        <div class="kt-form-control flex-1 w-full">
            <div class="custom-select-wrapper">
                <input id="table_general_search" class="kt-input w-full" placeholder="- Select Role -" autocomplete="off" value="{{ isset($data->id_table_general) ? $data->application_table_general->name : '' }}" type="text" required>
                <input id="id_table_general" name="id_table_general" value="{{ $data->id_table_general ?? '' }}" type="hidden" required>
                <div id="table_general_dropdown" class="custom-dropdown hidden"></div>
            </div>
        </div>
    </div>
</div>

<div class="kt-form-item">
    <div class="flex flex-col lg:flex-row items-start gap-3">
        <span class="kt-form-label w-52 pt-2"> Description </span>
        <div class="kt-form-control flex-1 w-full">
            {{ Html::textarea('description', (isset($data->description) ? $data->description : ''))->class(['kt-textarea'])->id('ex-textarea')->rows(4) }}
        </div>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('table_general_search');
        const hiddenInput = document.getElementById('id_table_general');
        const dropdown = document.getElementById('table_general_dropdown');
        let searchTimeout;

        // Search handler
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();

            clearTimeout(searchTimeout);

            if (query.length < 2) {
                dropdown.classList.add('hidden');
                return;
            }

            searchTimeout = setTimeout(() => {
                fetchData(query);
            }, 300);
        });

        // Fetch data dari API
        function fetchData(query) {
            fetch('{{ $url }}/data-search?q=' + encodeURIComponent(query))
                .then(response => response.json())
                .then(data => {
                    renderDropdown(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    dropdown.innerHTML = '<div class="custom-dropdown-empty">Error loading data</div>';
                    dropdown.classList.remove('hidden');
                });
        }

        // Render dropdown
        function renderDropdown(data) {
            if (data.length === 0) {
                dropdown.innerHTML = '<div class="custom-dropdown-empty">No results found</div>';
                dropdown.classList.remove('hidden');
                return;
            }

            dropdown.innerHTML = data.map(item =>
                `<div class="custom-dropdown-item" data-id="${item.id}" data-name="${item.name}"> ${item.name} </div>`
            ).join('');

            dropdown.classList.remove('hidden');

            dropdown.querySelectorAll('.custom-dropdown-item').forEach(item => {
                item.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    searchInput.value = name;
                    hiddenInput.value = id;
                    dropdown.classList.add('hidden');
                });
            });
        }

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        searchInput.addEventListener('blur', function() {
            setTimeout(() => {
                if (this.value.trim() === '') {
                    hiddenInput.value = '';
                }
            }, 200);
        });
    });
</script>
@endpush