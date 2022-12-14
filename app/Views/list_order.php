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
                <button type="button" class="btn btn-primary btnAdd" data-bs-toggle="modal" data-bs-target="#addModal">
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
                if ($orders_detail[0] != 'empty') :
                    foreach ($orders_detail as $row) :
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
                    endforeach;
                endif;
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
                    <?php csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="txtOrderCustomerId">Nome do Cliente:</label>
                                <select class="form-select" id="txtOrderCustomerId" name="txtOrderCustomerId">
                                    <option selected></option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtOrderProductId">Produto Adquirido:</label>
                                <select class="form-select" id="txtOrderProductId" name="txtOrderProductId">
                                    <option selected></option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtOrderStatus">Status do Pedido</label>
                                <select class="form-select" id="txtOrderStatus" name="txtOrderStatus">
                                    <option selected></option>
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
                    <?php csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="hdnOrderId" id="hdnOrderId" />
                                <label for="txtOrderCustomerId">Nome do Cliente:</label>
                                <select class="form-select" id="txtOrderCustomerId" name="txtOrderCustomerId">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtOrderProductId">Produto Adquirido:</label>
                                <select class="form-select" id="txtOrderProductId" name="txtOrderProductId">
                                    <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="txtOrderStatus">Status do Pedido</label>
                                <select class="form-select" id="txtOrderStatus" name="txtOrderStatus">
                                    <option></option>
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

                            let recived_data = res.response.retorno;

                            let status;
                            if (recived_data[0].data_request.status == 3) {
                                status = 'Cancelado';
                            } else if (recived_data[0].data_request.status == 2) {
                                status = 'Pago';
                            } else {
                                status = 'Em Aberto';
                            }

                            var order = '<tr id="' + recived_data[0].data_direcionador_db.id + '">';
                            order += '<td>' + recived_data[0].data_direcionador_db.id + '</td>';
                            order += '<td>' + recived_data[0].data_request.customer_id + '</td>';
                            order += '<td>' + recived_data[0].data_request.product_id + '</td>';
                            order += '<td>' + status + '</td>';
                            order += '<td><a data-id="' + recived_data[0].data_direcionador_db.id + '" class="btn btn-primary btnEdit">Editar</a>  <a data-id="' + recived_data[0].data_direcionador_db.id + '" class="btn btn-danger btnDelete">Deletar</a></td>';
                            order += '</tr>';
                            $('#orderTable tbody').prepend(order);
                            $('#addOrder')[0].reset();
                            $('#addModal').modal('hide');
                        },
                        error: function(data) {}
                    });
                }
            });

            $('body').on('click', '.btnAdd', function() {
                $.ajax({
                    url: 'order/add/',
                    type: "GET",
                    dataType: 'json',
                    success: function(res) {
                        let recived_data = res.response.retorno;
                        for (var i = 0; i < (recived_data[0].customer_data).length; i++) {

                            $('#addOrder #txtOrderCustomerId').append($('<option>', {
                                value: recived_data[0].customer_data[i],
                                text: recived_data[0].customer_data[i]
                            }));
                        }

                        for (var i = 0; i < (recived_data[0].product_data).length; i++) {
                            $('#addOrder #txtOrderProductId').append($('<option>', {
                                value: recived_data[0].product_data[i],
                                text: recived_data[0].product_data[i]
                            }));

                        }
                    }
                });
            });

            $('body').on('click', '.btnEdit', function() {
                var order_id = $(this).attr('data-id');
                $.ajax({
                    url: 'order/edit/' + order_id,
                    type: "GET",
                    dataType: 'json',
                    success: function(res) {

                        let recived_data = res.response.retorno;
                        $('#updateModal').modal('show');
                        $('#updateOrder #hdnOrderId').val(recived_data[0].data_selected.id);
                        $('#updateOrder #txtOrderCustomerId').val(recived_data[0].customer_data_specific.name);
                        $('#updateOrder #txtOrderProductId').val(recived_data[0].product_data_specific.title);
                        $('#updateOrder #txtOrderStatus').val(recived_data[0].data_selected.status);

                        for (var i = 0; i < (recived_data[0].customer_data).length; i++) {
                            let name_selected = false;

                            if (recived_data[0].customer_data[i] == recived_data[0].customer_data_specific.name) {
                                name_selected = true;
                            }

                            $('#updateOrder #txtOrderCustomerId').append($('<option>', {
                                value: recived_data[0].customer_data[i],
                                text: recived_data[0].customer_data[i],
                                selected: name_selected
                            }));

                            name_selected = false;
                        }

                        for (var i = 0; i < (recived_data[0].product_data).length; i++) {
                            let title_selected = false;

                            if (recived_data[0].product_data[i] == recived_data[0].product_data_specific.title) {
                                title_selected = true;
                            }

                            $('#updateOrder #txtOrderProductId').append($('<option>', {
                                value: recived_data[0].product_data[i],
                                text: recived_data[0].product_data[i],
                                selected: title_selected
                            }));

                            title_selected = false;
                        }

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

                            let recived_data = res.response.retorno;
                            let status;
                            if (recived_data[0].data_request.status == 3) {
                                status = 'Cancelado';
                            } else if (recived_data[0].data_request.status == 2) {
                                status = 'Pago';
                            } else {
                                status = 'Em Aberto';
                            }

                            var order = '<td>' + recived_data[0].data_request.id + '</td>';
                            order += '<td>' + recived_data[0].customer_data_specific.name + '</td>';
                            order += '<td>' + recived_data[0].product_data_specific.title + '</td>';
                            order += '<td>' + status + '</td>';
                            order += '<td><a data-id="' + recived_data[0].data_request.id + '" class="btn btn-primary btnEdit">Editar</a>  <a data-id="' + recived_data[0].data_request.id + '" class="btn btn-danger btnDelete">Deletar</a></td>';
                            $('#orderTable tbody #' + recived_data[0].data_request.id).html(order);
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