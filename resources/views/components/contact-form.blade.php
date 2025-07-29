<div>
    <form action="/contact/send" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Name:')}}</label>
            <input type="text" class="form-input rounded-md shadow-sm w-full" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Email:')}}</label>
            <input type="email" class="form-input rounded-md shadow-sm w-full" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="message" class="block text-gray-700 text-sm font-bold mb-2">{{__('general.Message:')}}</label>
            <textarea class="form-textarea rounded-md shadow-sm w-full" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
            @error('message')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('general.Send Message')}}</button>
    </form>
</div>
