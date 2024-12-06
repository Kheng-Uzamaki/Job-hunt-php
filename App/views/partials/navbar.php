<!-- Nav -->
<?php

use Framework\Session; ?>

<header class="bg-blue-900 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-3xl font-semibold">
            <a href="/">JOBHUNT</a>
        </h1>
        <?php if (Session::has('user')) : ?>
            <div class="text-xl">
                Welcome <strong class="text-blue-500">
                    <?= Session::get('user')['name'] ?>
                </strong>
            </div>
            <nav class="space-x-4">

                <div class="flex justify-between items-center gap-4">


                    <a
                        href="/listings/create"
                        class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300"><i class="fa fa-edit"></i> Post a Job</a>

                    <form method="POST" action="/auth/logout">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded hover:shadow-md transition duration-300">Logout</button>
                    </form>

                </div>


            <?php else : ?>
                <div class="flex justify-between items-center gap-4">
                    <a href="/auth/login" class="text-white hover:underline ">Login</a>
                    <a href="/auth/register" class="text-white hover:underline">Register</a>
                </div>

            <?php endif; ?>


            </nav>
    </div>
</header>