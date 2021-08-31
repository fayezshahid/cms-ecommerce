@include('welcome')

<div class="bg-gray-50 min-h-screen flex items-center justify-center px-16">
    <div class="relative w-full max-w-lg">
      <div class="absolute top-0 -left-4 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob "></div>
      <div class="absolute top-0 -right-4 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
      <div class="absolute -bottom-32 left-20 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
      <div class="m-8 relative space-y-4">
        @guest
            <div class="p-5 bg-white rounded-lg flex items-center justify-between space-x-8">
            <div class="flex-1 flex justify-between items-center">
                <div class="h-8 w-48 bg-gray-300 rounded text-center pt-1">Don't have a account?</div>
                <a href="{{ route('register') }}" class="w-24 h-6 rounded-lg bg-purple-300 text-center">Click here</a>
            </div>
            </div>
            <div class="p-5 bg-white rounded-lg flex items-center justify-between space-x-8">
            <div class="flex-1 flex justify-between items-center">
                <div class="h-15 w-48 bg-gray-300 rounded text-center">Have an account! Want to go log in?.</div>
                <a href="{{ route('login') }}" class="w-24 h-6 rounded-lg bg-purple-300 text-center">Click here</a>
            </div>
            </div>
        @endguest

        <div class="p-5 bg-white rounded-lg flex items-center justify-between space-x-8">
        <div class="flex-1 flex justify-between items-center">
            <div class="h-15 w-50 bg-gray-300 rounded text-center">Want to learn about us more?</div>
            <a href="https://adminlte.io/" class="w-24 h-6 rounded-lg bg-purple-300 text-center">Click here</a>
        </div>
        </div>

      </div>
    </div>
  </div>
