<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold text-center mb-6">Employee Pairs and Common Project Days</h2>

    <!-- File upload form -->
    <form action="{{ route('upload-file') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
        @csrf

        <!-- File Input -->
        <div class="mb-4">
            <label for="csv_file" class="block text-sm font-medium text-white mb-2">Upload CSV File</label>
            <input type="file" name="csv_file" id="csv_file" required
                   class="block w-full text-sm text-gray-100 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                Upload
            </button>
        </div>
    </form>
</div>
