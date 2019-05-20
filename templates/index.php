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
        <? foreach ($task_list as $task): ?>
            <?php if ($show_complete_tasks == 1 || $task['status'] == '0'): ?>
                <tr class="tasks__item task <?php if ($task['status'] == '1'): print "task--completed"; endif;?>
                <?php if ($task['date_end'] != NULL and $task['status'] != 1 and time_different($task) <= 86400) : print " task--important"; endif;?>">
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1"
                                <?php if ($task['status'] == '1'): print "checked"; endif;?> >
                            <span class="checkbox__text"><?= strip_tags($task['name']);?></span>
                        </label>
                    </td>
                    <td class="task__file">
                        <a class="download-link" href="#">Home.psd</a>
                    </td>
                    <td class="task__date"><?php if ($task['date_end'] != NULL){
                        print(date("d.m.Y", strtotime($task['date_end'])));
                    }
                        else {
                            print('Нет');
                        }
                        ;?></td>
                </tr>
            <?php endif;?>
        <? endforeach; ?>
    </table>
</main>