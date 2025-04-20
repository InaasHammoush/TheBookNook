<x-app-layout>
    <div class="max-w-3xl mx-auto py-12">
        <h2 class="text-2xl font-bold mb-6">Create a New Thread</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('threads.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" name="title" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" />
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Genre</label>
                <select name="genre_id" required class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="">Select a genre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Book (Search by Title)</label>
                <input type="text" id="book-search" placeholder="Type a book title..." class="w-full border-gray-300 rounded-lg shadow-sm mb-2" />

                <ul id="book-results" class="bg-white border rounded shadow-md max-h-48 overflow-y-auto hidden"></ul>

                <!-- Selected book info -->
                <input type="hidden" name="book_info" id="book-info" />
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Content</label>
                <textarea name="content" rows="6" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200"></textarea>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Create Thread</button>
        </form>
    </div>

    <script>
        document.getElementById('book-search').addEventListener('input', function () {
            const query = this.value;
            const resultsList = document.getElementById('book-results');
            const bookInfoInput = document.getElementById('book-info');

            if (query.length < 3) {
                resultsList.classList.add('hidden');
                resultsList.innerHTML = '';
                return;
            }

            fetch(`https://www.googleapis.com/books/v1/volumes?q=intitle:${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    resultsList.innerHTML = '';
                    if (data.items && data.items.length) {
                        data.items.slice(0, 10).forEach(book => {
                            const li = document.createElement('li');
                            li.textContent = book.volumeInfo.title + (book.volumeInfo.authors ? ` by ${book.volumeInfo.authors.join(', ')}` : '');
                            li.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer';
                            li.addEventListener('click', () => {
                                bookInfoInput.value = JSON.stringify({
                                    id: book.id,
                                    title: book.volumeInfo.title,
                                    authors: book.volumeInfo.authors || []
                                });
                                document.getElementById('book-search').value = book.volumeInfo.title;
                                resultsList.classList.add('hidden');
                            });
                            resultsList.appendChild(li);
                        });
                        resultsList.classList.remove('hidden');
                    } else {
                        resultsList.classList.add('hidden');
                    }
                })
                .catch(() => {
                    resultsList.innerHTML = '';
                    resultsList.classList.add('hidden');
                });
        });
    </script>
</x-app-layout>
