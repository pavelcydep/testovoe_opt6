<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Datatable Example</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3><strong>Laravel 8 Datatable Example</strong></h3>
                    <button id="createNewCompany" type="button" class="create btn btn-primary btn-sm">Добавить заказ</button>
                </div>
            </div>
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Email</th>
                        <th>Номер телефона</th>
                        <th>Адрес</th>
                        <th>Дата заказа</th>
                        <th>Детали заказа</th>
                        <th>Сумма</th>
                        
                        <th  width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="form" name="form" class="form-horizontal">
                    <input  type="hidden" name="order_id" id="order_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email"  name="email" placeholder="email" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Телефон</label>
                        <div class="col-sm-12">
                            <input type="phone" class="form-control" id="phone" name="phone" placeholder="номер телефона" value="" maxlength="50" required="">
                        </div>
                    </div>
                    
                    <div class="form-group">
<select id="select"  class="form-select" aria-label="Default select example">
  <option  >Выберите товар</option>
  @foreach($products as $product)
                            <option id="selectId" value="{{ $product->id }}"
                              >{{ $product->name }}</option>    
                        @endforeach
</select>
</div>
<div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Количество</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="count"  name="count" placeholder="количество" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
Дата заказа:
<input type="date" name="data-order" id="data-order" class="form-input">
</div>



<div id="map" style="width: 100%; height: 400px;"></div> 
<div class="form-group">
Адрес:
<input type="text" name="addres" id="address">
</div>
<div class="form-group">
Координаты:
<input type="text" name="ypoint" id="ypoint" class="form-input">
</div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class=" btn btn-primary  btn-submit"  value="create">Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>







<div class="modal fade" id="ajaxModelUpdate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading-update"></h4>
            </div>
            <div class="modal-body">
                <form id="form" name="form" class="form-horizontal">
                    <input type="hidden" name="order_id" id="order_id-update">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="email-update"  name="email" placeholder="email" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Телефон</label>
                        <div class="col-sm-12">
                            <input type="phone" class="form-control" id="phone-update" name="phone" placeholder="номер телефона" value="" maxlength="50" required="">
                        </div>
                    </div>
                    
                    <div class="form-group">
<select id="select-update"  class="form-select" aria-label="Default select example">
  <option  >Выберите товар</option>
  @foreach($products as $product)
                            <option value="{{ $product->id }}"
                              >{{ $product->name }}</option>    
                        @endforeach
</select>
</div>
<div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Количество</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="count-update"  name="count-update" placeholder="количество" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
Дата заказа:
<input type="date" name="data-order" id="data-order-update" class="form-input">
</div>



<div id="map2" style="width: 100%; height: 400px;"></div> 
<div class="form-group">
Адрес:
<input type="text" name="addres" id="address-update">
</div>
<div class="form-group">
Координаты:
<input type="text" name="point" id="point-update" class="form-input">
</div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class=" btn btn-primary  btn-update"  value="create">Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>









</body>
<script src="https://yandex.st/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
   
<script src="https://api-maps.yandex.ru/2.1/?apikey=2ca7f88e-79a8-4b7f-bd55-b47b2bf5f3fd&lang=ru_RU"></script>

<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'addres', name: 'addres'},
            {data: 'data_order', name: 'data_order'},
            {data: 'detail', name: 'detail'},
            {data: 'summa', name: 'summa'},
            {data:'action',name:'action'}
        ]
    });
  });



    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
  
    $('body').on('click', '.create', function() {
        $('#saveBtn').val("Сохранить");
        $('#form').trigger("reset");
        $('#modelHeading').html("Добавить заказ");
        $('#ajaxModel').modal('show');
    });
   


  
$(".btn-submit").click(function(e){
 
 e.preventDefault();
 alert($("input[name=data-order]").val());
 const phone = $("input[name=phone]").val();
 const addres = $("input[name=addres]").val();
 const email = $("input[name=email]").val();
 const count = $("input[name=count]").val();
 const data_order = $('#data-order').val();
 const product = document.getElementById("selectId").value;
 let _token   = $('meta[name="csrf-token"]').attr('content');

 $.ajax({
    type:'POST',
    url:"orders/create",
   
    data:{
       phone:phone,
       email:email,
       count:count,
     
       product:product,
       data_order:data_order,
       addres:addres,
       _token: _token
 },

    success:function(data){
       //alert(data.success);
    }
 });

});

$('body').on('click', '.edit', function() {
        var id = $(this).data('id');
        $.get("{{ url('/orders') }}" + '/' + id + '/edit', function(data) {
          
            $('#ajaxModelUpdate').modal('show');
            $('#order_id-update').val(data.id);
            $('#phone-update').val(data.phone);
            $('#email-update').val(data.email);
            $('#address-update').val(data.addres);
            $('#data-order-update').val(data.data_order);
            $('#point-update').val(data.point);

        })
    });


    $(".btn-update").click(function(e){
 
 e.preventDefault();

 const phone =   $('#phone-update').val();
 const addres = $('#address-update').val();
 const email =  $('#email-update').val();
 const count = $('#count-update').val();
 const point=$('#point-update').val();
 const data_order = $("input[name=data-order]").val();
 const product = document.getElementById("select-update").value;
 let _token   = $('meta[name="csrf-token"]').attr('content');
const order_id= $('#order_id-update').val();

 $.ajax({
    type:'POST',
    url:"/orders/update",
   
    data:{
       phone:phone,
       email:email,
       count:count,
       product:product,
       data_order:data_order,
       order_id:order_id,
       addres:addres,
       point:point,
       _token: _token
 },

    success:function(data){
       //alert(data.success);
    }
 });

});




$('body').on('click', '.delete', function() {
        var id = $(this).data("id");
        confirm("Are You sure want to delete !");
        $.ajax({
            type: "DELETE",
            url: "{{ (url('/orders')) }}" + '/' + id + '/destroy',
            success: function(data) {
                table.draw();
            },
            error: function(data) {
                console.log('Error:', data);
            }
        });
    });






    ymaps.ready(init);        
function init() {
	var myMap = new ymaps.Map("map", {
		center: [55.76, 37.64],
		zoom: 10
	}, {
		searchControlProvider: 'yandex#search'
	});
 
	/* Начальный адрес метки */
    var address = 'Россия, Москва, Тверская, д. 7';
	ymaps.geocode(address).then(function(res) {
		var coord = res.geoObjects.get(0).geometry.getCoordinates();
 
		var myPlacemark = new ymaps.Placemark(coord, null, {
			preset: 'islands#blueDotIcon',
			draggable: true
		});
 
		/* Событие dragend - получение нового адреса */
		myPlacemark.events.add('dragend', function(e){
			var cord = e.get('target').geometry.getCoordinates();
			$('#ypoint').val(cord);
			ymaps.geocode(cord).then(function(res) {
				var data = res.geoObjects.get(0).properties.getAll();
				$('#address').val(data.text);
			});
		});
		
		myMap.geoObjects.add(myPlacemark);	
		myMap.setCenter(coord, 15);
	});
}

ymaps.ready(init2);        
function init2() {
	var myMap2 = new ymaps.Map("map2", {
		center: [55.76, 37.64],
		zoom: 10
	}, {
		searchControlProvider: 'yandex#search'
	});
 
	/* Начальный адрес метки */

    var id = $(this).data('id');
    $.get("{{ url('/orders') }}" + '/' + id + '/edit', function(data) {
	var address = data.addres;
    });
	ymaps.geocode(address).then(function(res) {
		var coord = res.geoObjects.get(0).geometry.getCoordinates();
 
		var myPlacemark = new ymaps.Placemark(coord, null, {
			preset: 'islands#blueDotIcon',
			draggable: true
		});
 
		/* Событие dragend - получение нового адреса */
		myPlacemark.events.add('dragend', function(e){
			var cord = e.get('target').geometry.getCoordinates();
			$('#ypoint-update').val(cord);
			ymaps.geocode(cord).then(function(res) {
				var data = res.geoObjects.get(0).properties.getAll();
				$('#address-update').val(data.text);
			});
		});
		
		myMap2.geoObjects.add(myPlacemark);	
		myMap2.setCenter(coord, 15);
	});
}
</script>


</html>