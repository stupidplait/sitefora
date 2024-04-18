<section class="main_body">
    <? if (isset($_SESSION['admin'])) {
        if (isset($_POST['exit'])) {
            session_unset();
            echo "<script>document.location.href='$uri'</script>";
        }

        if ($uri === '/admin') { ?>
            <div class="content_bar">
                <p class="page_name-p">Добавить новость</p>
                <div class="auth">
                    <?
                    if (isset($_POST['add'])) {
                        $title = $_POST['title'];
                        $body = $_POST['body'];
                        $date = $_POST['date'];

                        $flag = true;
                    } ?>
                    <form method="post" class="auth_logins" enctype="multipart/form-data">
                        <textarea name="title" class="auth_input" placeholder="Введите название"><?= isset($title) ? $title : '' ?></textarea>
                        <p class="error">
                            <? if (isset($title) && !strlen($title)) {
                                echo 'Введите название';
                                $flag = false;
                            } ?>
                        </p>
                        <textarea name="body" class="auth_input" placeholder="Введите содержание"><?= isset($body) ? $body : '' ?></textarea>
                        <p class="error">
                            <? if (isset($body) && !strlen($body)) {
                                echo 'Введите содержание';
                                $flag = false;
                            } ?>
                        </p>
                        <input type="date" value="<?= isset($date) ? $date : date('Y-m-d', time()) ?>" class="auth_input" name="date">
                        <input type="file" name="image">
                        <p class="error">
                            <? if (isset($_POST['add'])) {
                                if ($_FILES['image']['name'] == NULL) {
                                    echo 'Выберите изображение';
                                    $flag = false;
                                } else if (!in_array($_FILES['image']['type'], ['image/webp', 'image/jpg', 'image/png'])) {
                                    echo 'Неверный формат изображения';
                                    $flag = false;
                                }
                            } ?>
                        </p>
                        <input type="submit" class="login_button" name="add" value="Добавить новость">
                        <? if (isset($_POST['add']) && $flag) {
                            $imagePath = 'assets/img/' . time() . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

                            $sql = "INSERT INTO news (title, body, image, created_at) VALUES (:title, :body, :image, :created_at)";
                            $prepare = $connect->prepare($sql);
                            $prepare->execute([
                                'title' => $title,
                                'body' => $body,
                                'image' => $imagePath,
                                'created_at' => $date,
                            ]);

                            echo '<script>document.location.href="/admin"</script>';
                        } ?>
                    </form>
                </div>
            </div>
            <li style="list-style: circle; margin: 30px 0 0 15px;">
                <a href="/admin-tim" class="userq_link">Перейти на страницу добавления пользователей</a>
            </li>
            <li style="list-style: circle; margin: 30px 0 0 15px;">
                <form method="post">
                    <input type="submit" class="login_button" name="exit" value="Выйти">
                </form>
            </li>
        <? } else { ?>
            <div class="content_bar">
                <p class="page_name-p">Список пользователей</p>
                <table class="items">
                    <thead>
                        <td>id</td>
                        <td>имя</td>
                        <td>фамилия</td>
                        <td>компания</td>
                        <td>удалить</td>
                    </thead>
                    <tbody class="item">
                        <?

                        if (isset($_GET['delete'])) {
                            $id = $_GET['delete'];
                            $sql = "DELETE FROM tim WHERE id = :id";
                            $prepare = $connect->prepare($sql);
                            $prepare->execute(['id' => $id]);

                            echo "<script>document.location.href='$uri'</script>";
                        }

                        $sql = "SELECT * FROM tim";
                        $tim = $connect->query($sql)->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($tim as $timItem) { ?>
                            <tr>
                                <td><?= $timItem['id'] ?></td>
                                <td><?= $timItem['name'] ?></td>
                                <td><?= $timItem['surname'] ?></td>
                                <td><?= $timItem['company'] ?></td>
                                <td><a href="?delete=<?= $timItem['id'] ?>">Удалить</a></td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
                <p class="page_name-p">Добавить пользователя</p>
                <div class="auth">
                    <?
                    if (isset($_POST['add'])) {
                        $name = $_POST['name'];
                        $surname = $_POST['surname'];
                        $company = $_POST['company'];
                        $link = $_POST['link'];

                        $flag = true;
                    } ?>
                    <form method="post" class="auth_logins" enctype="multipart/form-data">
                        <input name="name" class="auth_input" placeholder="Введите имя" value="<?= isset($name) ? $name : '' ?>">
                        <p class="error">
                            <? if (isset($name) && !strlen($name)) {
                                echo 'Введите имя';
                                $flag = false;
                            } ?>
                        </p>
                        <input name="surname" class="auth_input" placeholder="Введите фамилию" value="<?= isset($surname) ? $surname : '' ?>">
                        <p class="error">
                            <? if (isset($surname) && !strlen($surname)) {
                                echo 'Введите фамилию';
                                $flag = false;
                            } ?>
                        </p>
                        <input name="company" class="auth_input" placeholder="Введите компанию" value="<?= isset($company) ? $company : '' ?>">
                        <p class="error">
                            <? if (isset($company) && !strlen($company)) {
                                echo 'Введите компанию';
                                $flag = false;
                            } ?>
                        </p>
                        <input name="link" class="auth_input" placeholder="Вставьте ссылку" value="<?= isset($link) ? $link : '' ?>">
                        <p class="error">
                            <? if (isset($link) && !strlen($link)) {
                                echo 'Вставьте ссылку';
                                $flag = false;
                            } ?>
                        </p>
                        <input type="file" name="image">
                        <p class="error">
                            <? if (isset($_POST['add'])) {
                                if ($_FILES['image']['name'] == NULL) {
                                    echo 'Выберите изображение';
                                    $flag = false;
                                } else if (!in_array($_FILES['image']['type'], ['image/webp', 'image/jpg', 'image/png'])) {
                                    echo 'Неверный формат изображения';
                                    $flag = false;
                                }
                            } ?>
                        </p>
                        <input type="submit" class="login_button" name="add" value="Добавить новость">
                        <? if (isset($_POST['add']) && $flag) {
                            $imagePath = 'assets/img/' . time() . $_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);

                            $sql = "INSERT INTO tim (name, surname, company, link, image) VALUES (:name, :surname, :company, :link, :image)";
                            $prepare = $connect->prepare($sql);
                            $prepare->execute([
                                'name' => $name,
                                'surname' => $surname,
                                'company' => $company,
                                'link' => $link,
                                'image' => $imagePath,
                            ]);

                            echo "<script>document.location.href='$uri'</script>";
                        } ?>
                    </form>
                </div>
            </div>
            <li style="list-style: circle; margin: 30px 0 0 15px;">
                <a href="/admin" class="userq_link">Перейти на страницу добавления новостей</a>
            </li>
            <li style="list-style: circle; margin: 30px 0 0 15px;">
                <form method="post">
                    <input type="submit" class="login_button" name="exit" value="Выйти">
                </form>
            </li>
        <? }
    } else {
        $admin = [
            'login' => 'admin',
            'password' => 'Y2Knjkcnsqqoio1989!',
        ]; ?>
        <div class="content_bar">
            <p class="page_name-p">Панель администратора</p>
            <div class="auth">
                <? if (isset($_POST['signin'])) {
                    $login = $_POST['login'];
                    $password = $_POST['password'];

                    if ($login === $admin['login'] && $password === $admin['password']) {
                        $_SESSION['admin'] = [
                            'login' => $login,
                            'password' => $password,
                        ];

                        echo "<script>document.location.href='$uri'</script>";
                    }
                } ?>
                <form method="post" class="auth_logins">
                    <input type="text" class="auth_input" name="login" value="<?= isset($login) ? $login : '' ?>" placeholder="Enter Login">
                    <input type="password" class="auth_input" name="password" placeholder="Enter Password">
                    <input type="submit" class="login_button" name="signin" value="Авторизоваться">
                    <p class="error">
                        <? if (isset($_POST['signin']) && ($login !== $admin['login'] || $password != $admin['password'])) echo 'Неверный логин или пароль'; ?>
                    </p>
                </form>
            </div>
        </div>
    <? } ?>
</section>