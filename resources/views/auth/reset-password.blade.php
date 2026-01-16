<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/icons/borongan_icon.png') }}" type="image/x-icon">
    <title>J-Hunting | Change Password</title>
    @vite('resources/css/app.css')

</head>

<body>
    <div class="w-full fixed top-10 pl-30">
        <x-message-box />
    </div>
    <section class="bg-gray-100">
        <div class="login-main-container">
            <div class="login-sub-container border border-gray-300">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8 bg-gray-100 rounded-lg">
                    <h1 class="head-title text-center">
                        Reset Password
                    </h1>
                    <form id="update-password-form" class="space-y-4" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->get('token') }}">
                        <div class="text-center">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <p class="block mb-2 text-lg font-medium text-gray-900">{{ request()->get('email') }}</p>
                            <input type="hidden" name="email" value="{{ request()->get('email') }}" />
                        </div>

                        <div class="bg-gray-400 w-full h-[1px]"></div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">New
                                Password</label>
                            <input type="password" name="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-0 focus:outline-0 block w-full p-2.5" />
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                                Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-0 focus:outline-0 block w-full p-2.5" />
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-sky-700 hover:bg-blue-500 focus:ring-0 focus:outline-0 font-medium rounded text-sm px-5 py-2.5 text-center duration-200 cursor-pointer">Reset
                            Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        function message(color, title, content) {
            //green
            // "bg-green-100 border-green-500 text-green-700",

            //red
            //"bg-red-100 border-red-500 text-red-700",

            //sky (blue)
            //"bg-sky-100 border-sky-500 text-sky-700"

            $("#message-container").fadeIn();
            $("#message-container").addClass(color);
            $("#message-title").text(title);
            $("#message-content").text(content);

            setTimeout(() => {
                $("#message-container").fadeOut();
            }, 5000);
        }

        $(function() {

            $("#update-password-form").on("submit", function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('password.update') }}",
                    method: "post",
                    data: {
                        email: $("input[name='email']").val(),
                        password: $("input[name='password']").val(),
                        password_confirmation: $(
                            "input[name='password_confirmation']"
                        ).val(),
                        token: $("input[name='token']").val(),
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(res) {
                        message(
                            "bg-green-100 border-green-500 text-green-700",
                            "Password Reset Succesfully!",
                            res.message
                        );
                    },
                    error: function(res) {
                        const notif =
                            res.responseJSON && res.responseJSON.message ?
                            res.responseJSON.message :
                            "Something went wrong.";

                        message(
                            "bg-red-100 border-red-500 text-red-700",
                            "Psasword Reset Failed!",
                            notif
                        );
                    },
                });
            });
        });
    </script>
</body>

</html>
