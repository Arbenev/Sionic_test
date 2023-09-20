<?php
/** @var yii\web\View $this */
$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Sionic test task</h1>

        <p class="lead">Total: <?= $count ?></p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12 mb-3">
                <h2>List of products</h2>

                <table id="main">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Название</th>
                            <th>Код</th>
                            <th>Вес</th>
                            <th>Взаимозаменяемости</th>
                            <?php
                            foreach ($cities as $city) {
                                ?>
                                <th>Количество (<?= $city['name'] ?>)</th>
                                <th>Цена (<?= $city['name'] ?>)</th>
                                <?php
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rows as $row) {
                            ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['code'] ?></td>
                                <td><?= $row['weight'] ?></td>
                                <td><?= $row['usage'] ?></td>
                                <?php
                                foreach ($cities as $city) {
                                    ?>
                                    <td><?= $row['quantity_' . $city['suffix']] ?></td>
                                    <td><?= $row['price_' . $city['suffix']] ?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="col-lg-12 mb-3">
                <?php
                $pagesCount = $count / $length;
                echo yii\widgets\LinkPager::widget([
                    'pagination' => $pages,
                ]);
                ?>
                </div>

            </div>
        </div>

    </div>
</div>
