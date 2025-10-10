<?php require base_path("views/partials/header.php") ?>
<?php require base_path("views/partials/nav.php") ?>

<main>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="mx-auto h-10 w-auto" />
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight ">Login </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="/session" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm/6 font-medium ">Email address</label>
                    <div class="mt-2">
                        <input id="email" type="email" name="email" required autocomplete="email" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        <?php if (isset($error['email'])): ?>
                            <p class="text-red-500 text-xs mt-2"><?= $error['email'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium ">Password</label>

                    </div>
                    <div class="mt-2">
                        <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base  outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        <?php if (isset($error['password'])): ?>
                            <p class="text-red-500 text-xs mt-2"><?= $error['password'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Login</button>
                </div>
                <?php if (isset($error['emailPass'])): ?>
                    <p class="text-red-500 text-xs mt-2"><?= $error['emailPass'] ?></p>
                <?php endif; ?>
            </form>

        </div>
    </div>

</main>

<?php require base_path("views/partials/footer.php") ?>