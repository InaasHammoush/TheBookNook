<div class="relative max-w-3xl w-full">
    <input type="text" id="search"
           placeholder="Search threads or books..."
           class="w-full border border-gray-300 rounded-md px-3 py-1.5 text-sm shadow-sm focus:ring focus:ring-indigo-200" />

    <ul id="search-results"
        class="absolute bg-white border rounded shadow-lg mt-1 hidden z-50 max-h-60 overflow-y-auto w-full">
    </ul>
</div>


@push('scripts')
<script>
    const searchInput = document.getElementById('search');
    const resultsList = document.getElementById('search-results');

    searchInput.addEventListener('input', function () {
        const query = this.value;

        if (query.length < 2) {
            resultsList.classList.add('hidden');
            resultsList.innerHTML = '';
            return;
        }

        fetch(`/search-threads?query=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                console.log('Search response:', data); // ✅ DEBUG

                resultsList.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(thread => {
                        const li = document.createElement('li');
                        li.innerHTML = `<a href="/threads/${thread.id}" class="block px-4 py-2 hover:bg-gray-100 text-sm text-gray-800">${thread.title}</a>`;
                        resultsList.appendChild(li);
                    });
                    resultsList.classList.remove('hidden');
                } else {
                    resultsList.classList.add('hidden');
                }
            })
            .catch((err) => {
                console.error('Fetch failed:', err); // ✅ DEBUG
                resultsList.classList.add('hidden');
            });
    });

    document.addEventListener('click', function (e) {
        if (!searchInput.contains(e.target) && !resultsList.contains(e.target)) {
            resultsList.classList.add('hidden');
        }
    });
</script>
@endpush

