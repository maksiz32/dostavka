<!DOCTYPE html>
<html lang="ru_RU">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$pageName?></title>
    <style>
        .mainsort {
            display: flex;
            justify-content: space-between;
            max-width: 70%;
            align-items: center;
        }
        .mainsort-unit {
            padding: 8px;
            border-radius: 2px;
            text-decoration: none;
        }
        .mainsort-unit:hover {
            cursor: pointer;
            background-color: lightblue;
        }
        .btn {
            display: inline-block;
            padding: 10px;
            background-color: lightseagreen;
            border-radius: 6px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: aquamarine;
        }
        section {
            margin: 30px 0 0 0;
        }
        .tasklist {
            margin: 8px 0;
        }
        .tasklist-unit {
            margin: 0 50px 0 20px;
        }
        .tasklist-unit > svg {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <main class="main">
        <h1><?=$pageName?></h1>
        <section>
            <?php if ($username === null) :?>
            <a href="/?controller=security" class="btn">Войти</a>
            <?php else :?>
                <p>Вы вошли как <strong><?=$username?></strong></p>
            <a href="/?controller=security&action=logout" class="btn">Выйти</a>
            <?php endif ?>
        </section>
        <article>
            <?php if (count($tasks) > 0) :?>
            <section class="mainsort">
                <span>
                    Сортировка:
                </span>
                <a href="/?controller=home&sort=name" class="mainsort-unit">
                    по Имени Пользователя
                </a>
                <a href="/?controller=home&sort=mail" class="mainsort-unit">
                    по Email
                </a>
                <a href="/?controller=home&sort=done" class="mainsort-unit">
                    по Выполнению
                </a>
            </section>
            <h2>Список с задачами:</h2>
            <?php if($countPages > 0) :?>
                <section class="pagination">
                <?php for($i=1; $i <= $countPages; $i++) :?>
                    <a href="/?controller=home&page=<?=$i?>"><?=$i?></a>
                <?php endfor ?>
            <?php endif ?>
            <ul>
                <?php foreach($tasks as $task) :?>
                    <li class="tasklist">
                        <span class="tasklist-unit"><?=$task['username']?></span>
                        <span class="tasklist-unit"><?=$task['email']?></span>
                        <span class="tasklist-unit"><?=$task['description']?></span>
                        <span class="tasklist-unit">
                            <?php if($task['isDone'] === '0') :?>
                                <svg height="30" viewBox="0 0 511.996 511.996" width="30" xmlns="http://www.w3.org/2000/svg"><path d="m473.104 112.473v358.908c0 22.43-18.186 40.616-40.616 40.616h-352.98c-22.43 0-40.616-18.186-40.616-40.616v-430.762c0-22.43 18.186-40.616 40.616-40.616h281.127z" fill="#f8f6f9"/><path d="m103.484 511.993h-23.972c-22.427 0-40.62-18.182-40.62-40.619v-430.755c0-22.437 18.193-40.619 40.62-40.619h23.972c-22.437 0-40.62 18.182-40.62 40.619v430.754c0 22.437 18.183 40.62 40.62 40.62z" fill="#dddaec"/><path d="m473.104 112.473h-71.854c-22.43 0-40.616-18.186-40.616-40.616v-71.853" fill="#dddaec"/><path d="m308.996 266.941 45.285-45.285c7.641-7.641 7.641-20.03 0-27.671l-25.327-25.327c-7.641-7.641-20.03-7.641-27.671 0l-45.286 45.286-45.285-45.286c-7.641-7.641-20.03-7.641-27.671 0l-25.327 25.327c-7.641 7.641-7.641 20.03 0 27.671l45.286 45.285-45.286 45.286c-7.641 7.641-7.641 20.03 0 27.671l25.327 25.327c7.641 7.641 20.03 7.641 27.671 0l45.285-45.285 45.286 45.285c7.641 7.641 20.03 7.641 27.671 0l25.327-25.327c7.641-7.641 7.641-20.03 0-27.671z" fill="#dd636e"/><path d="m267.709 225.654 56.996-56.996c.67-.67 1.388-1.26 2.125-1.813-7.664-5.748-18.575-5.158-25.546 1.813l-45.286 45.286z"/><path d="m206.464 365.225-25.327-25.327c-7.641-7.641-7.641-20.03 0-27.671l45.285-45.286-45.285-45.285c-7.641-7.641-7.641-20.03 0-27.671l25.327-25.327c.67-.67 1.388-1.26 2.125-1.813-7.664-5.748-18.575-5.158-25.546 1.813l-25.327 25.327c-7.641 7.641-7.641 20.03 0 27.671l45.284 45.285-45.286 45.286c-7.641 7.641-7.641 20.03 0 27.671l25.327 25.327c6.971 6.971 17.882 7.561 25.546 1.813-.736-.553-1.453-1.143-2.123-1.813z"/><path d="m324.705 365.225-56.996-56.996-11.711 11.711 45.286 45.285c6.971 6.971 17.882 7.561 25.546 1.813-.737-.553-1.454-1.143-2.125-1.813z"/></svg>
                                <?php if ($user && $user === 'admin') :?>
                                    <a class="btn" href="/?controller=task&action=taskdone&task=<?=$task['id']?>">Выполнено</a>
                                <?php endif ?>
                            <?php else :?>
                                <svg height="30" viewBox="0 0 511.996 511.996" width="30" xmlns="http://www.w3.org/2000/svg"><path d="m473.104 112.473v358.908c0 22.43-18.186 40.616-40.616 40.616h-352.98c-22.43 0-40.616-18.186-40.616-40.616v-430.762c0-22.43 18.186-40.616 40.616-40.616h281.127z" fill="#f8f6f9"/><path d="m473.104 112.473h-71.854c-22.43 0-40.616-18.186-40.616-40.616v-71.853" fill="#dddaec"/><path d="m373.134 175.972c5.167-10.413.912-23.033-9.501-28.2l-32.583-16.139c-10.413-5.167-23.033-.912-28.2 9.501l-64.477 130.09-31.399-52.513c-5.966-9.981-18.875-13.228-28.856-7.262l-31.207 18.651c-9.965 5.966-13.228 18.875-7.262 28.856l61.87 103.49c3.951 6.606 11.197 10.541 18.875 10.237l43.859-1.728c7.694-.304 14.604-4.783 18.011-11.677z" fill="#95d6a4"/>fill="#78c2a4"><path d="m251.489 293.16 75.349-152.026c1.68-3.387 4.157-6.108 7.082-8.08l-2.87-1.422c-10.413-5.167-23.033-.912-28.2 9.501l-64.477 130.09z"/><path d="m225.507 362.446-61.87-103.49c-5.966-9.981-2.703-22.889 7.262-28.856l29.954-17.902c-6.571-4.529-15.432-5.114-22.735-.749l-31.207 18.651c-9.965 5.966-13.228 18.875-7.262 28.856l61.87 103.49c3.951 6.606 11.197 10.541 18.874 10.237l17.774-.7c-5.219-1.391-9.803-4.76-12.66-9.537z"/><path d="m103.484 511.993h-23.972c-22.427 0-40.62-18.182-40.62-40.619v-430.755c0-22.437 18.193-40.619 40.62-40.619h23.972c-22.437 0-40.62 18.182-40.62 40.619v430.754c0 22.437 18.183 40.62 40.62 40.62z" fill="#dddaec"/></svg>
                            <?php endif ?>
                        </span>
                    </li>
                <?php endforeach ?>
            </ul>
            <?php endif ?>
                <form action="/?controller=home&action=newtask" method="post">
                    <label for="username">Имя пользователя:</label>
                    <input type="text" name="username">
                    <label for="email">Email:</label>
                    <input type="text" name="email">
                    <label for="newtask">Задача:</label>
                    <input type="text" name="newtask">
                    <button type="submit">Добавить</button>
                </form>
        </article>
    </main>
</body>
</html>