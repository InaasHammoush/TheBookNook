<div class="relative mb-6">
    <input type="text" id="search" placeholder="Search threads or books..."
           class="w-full border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring focus:ring-indigo-200">

    <ul id="search-results"
        class="absolute w-full bg-white border rounded shadow-lg mt-1 hidden z-50 max-h-60 overflow-y-auto"></ul>
</div>

@push('scripts')
<script>
    document.getElementById('search').addEventListener('input', function () {
        const query = this.value;
        const resultsList = document.getElementById('search-results');

        if (query.length < 2) {
            resultsList.classList.add('hidden');
            resultsList.innerHTML = '';
            return;
        }

        fetch(`/search-threads?query=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                resultsList.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(thread => {
                        const li = document.createElement('li');
                        li.innerHTML = `<a href="/threads/${thread.id}" class="block px-4 py-2 hover:bg-gray-100 text-gray-800">${thread.title}</a>`;
                        resultsList.appendChild(li);
                    });
                    resultsList.classList.remove('hidden');
                } else {
                    resultsList.classList.add('hidden');
                }
            })
            .catch(() => {
                resultsList.classList.add('hidden');
            });
    });
</script>
@endpush
