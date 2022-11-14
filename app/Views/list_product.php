<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Lista Produtos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

</head>

<body>
    <div class="container"><br /><br />
        <div class="row">
            <div class="col-lg-7">
                <h2>Lista Produtos</h2>
            </div>
            <div class="col-lg-5">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" onClick="return redirect('<?php echo base_url(); ?>/customer');">
                    Lista de Clientes
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" onClick="return redirect('<?php echo base_url(); ?>/order');">
                    Pedidos de Compra
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Novo Produto
                </button>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="productTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th width="280px">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products_detail as $row) {
                ?>
                    <tr id="<?php echo esc($row['id']); ?>">
                        <td><?php echo esc($row['id']); ?></td>
                        <td><?php echo esc($row['title']); ?></td>
                        <td><?php echo esc($row['price']); ?></td>
                        <td>
                            <a data-id="<?php echo esc($row['id']); ?>" class="btn btn-primary btnEdit">Editar</a>
                            <a data-id="<?php echo esc($row['id']); ?>" class="btn btn-danger btnDelete">Deletar</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Novo Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <form id="addProduct" name="addProduct" action="<?php echo site_url('product/store'); ?>" method="post">
                    <?php csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="txtProductTitle">Nome:</label>
                                <input type="text" class="form-control" id="txtProductTitle" placeholder="Adicione nome do Produto" name="txtProductTitle">
                            </div>
                            <div class="form-group">
                                <label for="txtProductPrice">Preço:</label>
                                <input type="text" class="form-control" id="txtProductPrice" placeholder="Preço do produto" name="txtProductPrice">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Atualizar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <form id="updateProduct" name="updateProduct" action="<?php echo site_url('product/update'); ?>" method="post">
                    <?php csrf_field(); ?>
                        <div class="modal-body">
                            <input type="hidden" name="hdnProductId" id="hdnProductId" />
                            <div class="form-group">
                                <label for="txtProductTitle">Nome:</label>
                                <input type="text" class="form-control" id="txtProductTitle" placeholder="Adicione nome do Produto" name="txtProductTitle">
                            </div>
                            <div class="form-group">
                                <label for="txtProductPrice">Preço:</label>
                                <input type="text" class="form-control" id="txtProductPrice" placeholder="Preço do produto" name="txtProductPrice">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();

            $("#addProduct").validate({
                rules: {
                    txtProductTitle: "required",
                    txtProductPrice: "required"
                },
                messages: {},

                submitHandler: function(form) {
                    var form_action = $("#addProduct").attr("action");
                    $.ajax({
                        data: $('#addProduct').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        success: function(res) {
                            let recived_data = res.response.retorno;
                            var product = '<tr id="' + recived_data[0].id + '">';
                            product += '<td>' + recived_data[0].id + '</td>';
                            product += '<td>' + recived_data[0].title + '</td>';
                            product += '<td>' + recived_data[0].price + '</td>';
                            product += '<td><a data-id="' + recived_data[0].id + '" class="btn btn-primary btnEdit">Editar</a>  <a data-id="' + recived_data[0].id + '" class="btn btn-danger btnDelete">Deletar</a></td>';
                            product += '</tr>';
                            $('#productTable tbody').prepend(product);
                            $('#addProduct')[0].reset();
                            $('#addModal').modal('hide');
                        },
                        error: function(data) {}
                    });
                }
            });

            $('body').on('click', '.btnEdit', function() {
                var product_id = $(this).attr('data-id');
                $.ajax({
                    url: 'product/edit/' + product_id,
                    type: "GET",
                    dataType: 'json',
                    success: function(res) {
                        let recived_data = res.response.retorno;
                        $('#updateModal').modal('show');
                        $('#updateProduct #hdnProductId').val(recived_data[0].id);
                        $('#updateProduct #txtProductTitle').val(recived_data[0].title);
                        $('#updateProduct #txtProductPrice').val(recived_data[0].price);
                    },
                    error: function(data) {}
                });
            });

            $("#updateProduct").validate({
                rules: {
                    txtProductTitle: "required",
                    txtProductPrice: "required",
                },
                messages: {},
                submitHandler: function(form) {
                    var form_action = $("#updateProduct").attr("action");
                    $.ajax({
                        data: $('#updateProduct').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        success: function(res) {
                            let recived_data = res.response.retorno;
                            var product = '<td>' + recived_data[0].id + '</td>';
                            product += '<td>' + recived_data[0].title + '</td>';
                            product += '<td>' + recived_data[0].price + '</td>';
                            product += '<td><a data-id="' + recived_data[0].id + '" class="btn btn-primary btnEdit">Editar</a>  <a data-id="' + recived_data[0].id + '" class="btn btn-danger btnDelete">Deletar</a></td>';
                            $('#productTable tbody #' + recived_data[0].id).html(product);
                            $('#updateProduct')[0].reset();
                            $('#updateModal').modal('hide');
                        },
                        error: function(data) {}
                    });
                }
            });

            $('body').on('click', '.btnDelete', function() {
                var product_id = $(this).attr('data-id');
                $.get('product/delete/' + product_id, function(data) {
                    $('#productTable tbody #' + product_id).remove();
                })
            });
        });

        function redirect(url) {
            window.location.href = url;
            return false;
        }
    </script>
</body>

</html>