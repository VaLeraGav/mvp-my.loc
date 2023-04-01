<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список товаров
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMIN ?>"><i class="fa fa-dashboard"></i>Главная</a></li>
        <li class="breadcrumb-item active">Список товаров</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Категория</th>
                                <th>Наименование</th>
                                <th>Цена</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($products as $product): ?>
                                    <td><?=$product['id'];?></td>
                                    <td><?=$product['cat'];?></td>
                                    <td><?=$product['title'];?></td>
                                    <td><?=$product['price'];?> $</td>
                                    <td><?=$product['status'] ? 'On' : 'Off';?></td>
                                    <td>
                                        <a href="<?=ADMIN;?>/product/edit?id=<?=$product['id'];?>">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                        <a href="<?=ADMIN;?>/product/edit-modification?id=<?=$product['id'];?>">
                                            <i class="fa fa-fw fa-eye ml-3"></i>
                                        </a>
                                        <a href="<?=ADMIN;?>/product/edit-detail?id=<?=$product['id'];?>">
                                            <i class="fa fa-fw fa-eye ml-3"></i>
                                        </a>
                                        <a class="delete" href="<?=ADMIN;?>/product/delete?id=<?=$product['id'];?>">
                                            <i class="delete fa fa-fw fa-close text-danger ml-3"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <?php if($pagination->countPages > 1): ?>
                            <?=$pagination;?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

</section>