<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Add Enrollment</h2>

        <form method="POST" action="{{ route('enrollments.store') }}">
            @csrf

            <div>
                <label>Student Name</label>
                <input type="text" name="student_name" class="border p-2 w-full">
            </div>

            <div class="mt-4">
                <label>Email</label>
                <input type="email" name="email" class="border p-2 w-full">
            </div>

            <div class="mt-4">
                <label>Course</label>
                <input type="text" name="course" class="border p-2 w-full">
            </div>

            <button class="mt-4 bg-blue-500 text-white px-4 py-2">
                Save
            </button>
        </form>
    </div>
</x-app-layout>