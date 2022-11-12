<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Lista Pedidos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
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
                <h2>Lista Pedidos</h2>
            </div>
            <div class="col-lg-5">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" onClick="return redirect('<?php echo base_url(); ?>/customer');">
                    Lista de Clientes
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" onClick="return redirect('<?php echo base_url(); ?>/product');">
                    Lista de Produtos
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Novo Pedido
                </button>
            </div>
        </div>

        <table class="table table-bordered table-striped" id="orderTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nome do Cliente</th>
                    <th>Produto Adquirido</th>
                    <th>Status do Pedido</th>
                    <th width="280px">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($orders_detail as $row) {
                ?>
                    <tr id="<?php echo esc($row['id']); ?>">
                        <td><?php echo esc($row['id']); ?></td>
                        <td><?php echo esc($row['customer_id']); ?></td>
                        <td><?php echo esc($row['product_id']); ?></td>
                        <td><?php
                            if (esc($row['status']) == 3) {
                                echo 'Cancelado';
                            } elseif (esc($row['status']) == 2) {
                                echo 'Pago';
                            } else {
                                echo 'Em Aberto';
                            }

                            ?></td>
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
                        <h5 class="modal-title" id="ModalLabel">Novo Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <form id="addOrder" name="addOrder" action="<?php echo site_url('order/store'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="txtOrderCustomerId">Nome do Cliente:</label>
                                <input type="text" class="form-control" id="txtOrderCustomerId" placeholder="Adicione nome do Cliente" name="txtOrderCustomerId">
                            </div>
                            <div class="form-group">
                                <label for="txtOrderProductId">Produto Adquirido:</label>
                                <input type="text" class="form-control" id="txtOrderProductId" placeholder="Nome do Produto" name="txtOrderProductId">
                            </div>
                            <div class="form-group">
                                <label for="txtOrderStatus">Status do Pedido</label>
                                <select class="form-select" id="txtOrderStatus" name="txtOrderStatus">
                                    <option selected>Escolha o status</option>
                                    <option value=1>Em Aberto</option>
                                    <option value=2>Pago</option>
                                    <option value=3>Cancelado</option>
                                </select>
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
                        <h5 class="modal-title" id="ModalLabel">Atualizar Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <form id="updateOrder" name="updateOrder" action="<?php echo site_url('order/update'); ?>" method="post">
                        <div class="modal-body">
                            <input type="hidden" name="hdnOrderId" id="hdnOrderId" />
                            <div class="form-group">
                                <label for="txtOrderCustomerId">Nome do Cliente:</label>
                                <input type="text" class="form-control" id="txtOrderCustomerId" placeholder="Adicione nome do Cliente" name="txtOrderCustomerId">
                            </div>
                            <div class="form-group">
                                <label for="txtOrderProductId">Produto Adquirido:</label>
                                <input type="text" class="form-control" id="txtOrderProductId" placeholder="Nome do Produto" name="txtOrderProductId">
                            </div>
                            <label for="txtOrderStatus">Status do Pedido:</label>
                            <select class="form-select" id="txtOrderStatus" name="txtOrderStatus">
                                <option selected>Escolha o status</option>
                                <option value=1>Em Aberto</option>
                                <option value=2>Pago</option>
                                <option value=3>Cancelado</option>
                            </select>
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

    <script>
        $(document).ready(function() {
            $('#orderTable').DataTable();

            $("#addOrder").validate({
                rules: {
                    txtOrderCustomerId: "required",
                    txtOrderProductId: "required",
                    txtOrderStatus: "required"
                },
                messages: {},

                submitHandler: function(form) {
                    var form_action = $("#addOrder").attr("action");
                    $.ajax({
                        data: $('#addOrder').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        success: function(res) {
                            var order = '<tr id="' + res.data.id + '">';
                            order += '<td>' + res.data.id + '</td>';
                            order += '<td>' + res.data.customer_id + '</td>';
                            order += '<td>' + res.data.product_id + '</td>';
                            order += '<td>' + res.data.status + '</td>';
                            order += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Editar</a>  <a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Deletar</a></td>';
                            order += '</tr>';
                            $('#orderTable tbody').prepend(order);
                            $('#addOrder')[0].reset();
                            $('#addModal').modal('hide');
                        },
                        error: function(data) {}
                    });
                }
            });

            $('body').on('click', '.btnEdit', function() {
                var order_id = $(this).attr('data-id');
                $.ajax({
                    url: 'order/edit/' + order_id,
                    type: "GET",
                    dataType: 'json',
                    success: function(res) {
                        $('#updateModal').modal('show');
                        $('#updateOrder #hdnOrderId').val(res.data.id);
                        $('#updateOrder #txtOrderCustomerId').val(res.data.customer_id);
                        $('#updateOrder #txtOrderProductId').val(res.data.product_id);
                        $('#updateOrder #txtOrderStatus').val(res.data.status);
                    },
                    error: function(data) {}
                });
            });

            $("#updateOrder").validate({
                rules: {
                    txtOrderCustomerId: "required",
                    txtOrderProductId: "required",
                    txtOrderStatus: "required"
                },
                messages: {},
                submitHandler: function(form) {
                    var form_action = $("#updateOrder").attr("action");
                    $.ajax({
                        data: $('#updateOrder').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        success: function(res) {
                            var order = '<td>' + res.data.id + '</td>';
                            order += '<td>' + res.data.customer_id + '</td>';
                            order += '<td>' + res.data.product_id + '</td>';
                            order += '<td>' + res.data.status + '</td>';
                            order += '<td><a data-id="' + res.data.id + '" class="btn btn-primary btnEdit">Editar</a>  <a data-id="' + res.data.id + '" class="btn btn-danger btnDelete">Deletar</a></td>';
                            $('#orderTable tbody #' + res.data.id).html(order);
                            $('#updateOrder')[0].reset();
                            $('#updateModal').modal('hide');
                        },
                        error: function(data) {}
                    });
                }
            });

            $('body').on('click', '.btnDelete', function() {
                var order_id = $(this).attr('data-id');
                $.get('order/delete/' + order_id, function(data) {
                    $('#orderTable tbody #' + order_id).remove();
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