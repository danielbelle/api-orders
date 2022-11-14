<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Lista Clientes</title>
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
                <h2>Lista Clientes</h2>
            </div>
            <div class="col-lg-5">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" onClick="return redirect('<?php echo base_url(); ?>/product');">
                    Lista de Produtos
                </button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" onClick="return redirect('<?php echo base_url(); ?>/order');">
                    Pedidos de Compra
                </button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                    Novo Cliente
                </button>
            </div>
        </div>
        <table class="table table-bordered table-striped" id="customerTable">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th width="280px">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($customers_detail as $row) {
                ?>
                    <tr id="<?php echo $row['id']; ?>">
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['document']; ?></td>
                        <td>
                            <a data-id="<?php echo $row['id']; ?>" class="btn btn-primary btnEdit">Editar</a>
                            <a data-id="<?php echo $row['id']; ?>" class="btn btn-danger btnDelete">Deletar</a>
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
                        <h5 class="modal-title" id="ModalLabel">Novo Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <form id="addCustomer" name="addCustomer" action="<?php echo site_url('customer/store'); ?>" method="post">
                        <?php csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="txtCustomerName">Nome:</label>
                                <input type="text" class="form-control" id="txtCustomerName" placeholder="Nome" name="txtCustomerName">
                            </div>
                            <div class="form-group">
                                <label for="txtCustomerDocument">Documento:</label>
                                <input type="text" class="form-control" id="txtCustomerDocument" placeholder="Documento" name="txtCustomerDocument">
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
                        <h5 class="modal-title" id="ModalLabel">Atualizar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <form id="updateCustomer" name="updateCustomer" action="<?php echo site_url('customer/update'); ?>" method="post">
                        <?php csrf_field(); ?>
                        <div class="modal-body">
                            <input type="hidden" name="hdnCustomerId" id="hdnCustomerId" />
                            <div class="form-group">
                                <label for="txtCustomerName">Nome:</label>
                                <input type="text" class="form-control" id="txtCustomerName" placeholder="Nome" name="txtCustomerName">
                            </div>
                            <div class="form-group">
                                <label for="txtCustomerDocument">Documento:</label>
                                <input type="text" class="form-control" id="txtCustomerDocument" placeholder="Documento" name="txtCustomerDocument">
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
            $('#customerTable').DataTable();

            $("#addCustomer").validate({
                rules: {
                    txtCustomerName: "required",
                    txtCustomerDocument: "required"
                },
                messages: {},

                submitHandler: function(form) {
                    var form_action = $("#addCustomer").attr("action");
                    $.ajax({
                        data: $('#addCustomer').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        success: function(res) {
                            let recived_data = res.response.retorno;
                            var customer = '<tr id="' + recived_data[0].id + '">';
                            customer += '<td>' + recived_data[0].id + '</td>';
                            customer += '<td>' + recived_data[0].name + '</td>';
                            customer += '<td>' + recived_data[0].document + '</td>';
                            customer += '<td><a data-id="' + recived_data[0].id + '" class="btn btn-primary btnEdit">Editar</a>  <a data-id="' + recived_data[0].id + '" class="btn btn-danger btnDelete">Deletar</a></td>';
                            customer += '</tr>';
                            $('#customerTable tbody').prepend(customer);
                            $('#addCustomer')[0].reset();
                            $('#addModal').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();
                        },
                        error: function(data) {}
                    });
                }
            });

            $('body').on('click', '.btnEdit', function() {
                var customer_id = $(this).attr('data-id');
                $.ajax({
                    url: 'customer/edit/' + customer_id,
                    type: "GET",
                    dataType: 'json',
                    success: function(res) {
                        let recived_data = res.response.retorno;
                        $('#updateModal').modal('show');
                        $('#updateCustomer #hdnCustomerId').val(recived_data[0].id);
                        $('#updateCustomer #txtCustomerName').val(recived_data[0].name);
                        $('#updateCustomer #txtCustomerDocument').val(recived_data[0].document);
                    },
                    error: function(data) {}
                });
            });

            $("#updateCustomer").validate({
                rules: {
                    txtCustomerName: "required",
                    txtCustomerDocument: "required"
                },
                messages: {},
                submitHandler: function(form) {
                    var form_action = $("#updateCustomer").attr("action");
                    $.ajax({
                        data: $('#updateCustomer').serialize(),
                        url: form_action,
                        type: "POST",
                        dataType: 'json',
                        success: function(res) {
                            let recived_data = res.response.retorno;
                            var customer = '<td>' + recived_data[0].id + '</td>';
                            customer += '<td>' + recived_data[0].name + '</td>';
                            customer += '<td>' + recived_data[0].document + '</td>';
                            customer += '<td><a data-id="' + recived_data[0].id + '" class="btn btn-primary btnEdit">Editar</a>  <a data-id="' + recived_data[0].id + '" class="btn btn-danger btnDelete">Deletar</a></td>';
                            $('#customerTable tbody #' + recived_data[0].id).html(customer);
                            $('#updateCustomer')[0].reset();
                            $('#updateModal').modal('hide');
                        },
                        error: function(data) {}
                    });
                }
            });

            $('body').on('click', '.btnDelete', function() {
                var customer_id = $(this).attr('data-id');
                $.get('customer/delete/' + customer_id, function(data) {
                    $('#customerTable tbody #' + customer_id).remove();
                })
            });
        });

        function redirect(url) {
            window.location.href = url;
            return false;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>