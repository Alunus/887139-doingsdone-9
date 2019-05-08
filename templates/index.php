<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox"
                <?php if ($show_complete_tasks == 1): ?> checked <?php endif;?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">
        <?php $show_complete_tasks = rand(0, 1);?>
        <? foreach ($task_list as $key): ?>
            <?php if ($show_complete_tasks == 1 || $key['is_complete'] == 'false'): ?>
                <tr class="tasks__item task <?php if ($key['is_complete'] == 'true'): print "task--completed"; endif;?>">
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1"
                                <?php if ($key['is_complete'] == 'true'): print "checked"; endif;?> >
                            <span class="checkbox__text"><?= $key['task'];?></span>
                        </label>
                    </td>
                    <td class="task__file">
                        <a class="download-link" href="#">Home.psd</a>
                    </td>

                    <td class="task__date"><?=$key['date'];?></td>
                </tr>
            <?php endif;?>
        <? endforeach; ?>
    </table>
</main>