@extends("layouts.document")
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>បញ្ជីប្រភេទឯកសារ</strong>&nbsp;&nbsp;
                <a href="#" onclick="addItem(event)">បន្ថែម</a>
            </div>
            <div class="card-block">
                {{csrf_field()}}
                <ul class="list" id="list">
                    @foreach($cats as $cat)
                        <li id="{{$cat->id}}"><a href="{{url('/sub1/'.$cat->id)}}">{{$cat->name}}</a>&nbsp;&nbsp;
                            <a href="#" class="text-success" onclick="edit(this,event)"><i class="fa fa-pencil"></i></a>&nbsp;
                            <a href="#" class="text-danger" onclick="rm(this,event)"><i class="fa fa-remove"></i></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        var burl = "{{url('/')}}";
        var xname = "";
        function addItem(evt) {
            var str = "<li id='0'><input type='text' size='45'>&nbsp;<button type='button' onclick='save(this)'>រក្សាទុក</button><button type='button' class='text-danger' onclick='cancelItem(this)'>បោះបង់</button></li>";
            $("#list").prepend(str);
        }
        function edit(obj, evt) {
            evt.preventDefault();
            var li = $(obj).parent();
            var name = $(li).text().trim();
            var str = "<input type='text' size='45' value='" + name + "'>&nbsp;<button type='button' onclick='saveEdit(this)'>រក្សាទុក</button><button type='button' class='text-danger' onclick='cancelEdit(this)'>បោះបង់</button>";
            $(li).html(str);
            xname = name;
        }
        function cancelEdit(obj)
        {
            var li = $(obj).parent();
            var id = $(li).attr("id");
            var str = "<a href='" + burl + "/sub1/" + id + "'>" + xname + "</a>&nbsp;&nbsp;";
            str += "<a href='#' class='text-success' onclick='edit(this,event)'><i class='fa fa-pencil'></i></a>&nbsp;";
            str += "<a href='#' class='text-danger' onclick='rm(this,event)'><i class='fa fa-remove'></i></a>";
            $(li).html(str);
        }
//
        function cancelItem(obj) {
            $(obj).parent().remove();
        }
        function saveEdit(obj) {
            var li = $(obj).parent();
            var input = $(li).children("input");
            var cat = {
                id: $(li).attr("id"),
                name: $(input).val()
            }
            $.ajax({
                type: "POST",
                url: burl + "/category/update",
                data: cat,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                },
                success: function (sms) {
                    if (sms > 0) {
                        var str = "<a href='" + burl + "/sub1/" + cat.id + "'>" + cat.name + "</a>&nbsp;&nbsp;";
                        str += "<a href='#' class='text-success' onclick='edit(this,event)'><i class='fa fa-pencil'></i></a>&nbsp;";
                        str += "<a href='#' class='text-danger' onclick='rm(this,event)'><i class='fa fa-remove'></i></a>";
                        $(li).html(str);
                    }

                }
            });
        }
        function save(obj) {
            var li = $(obj).parent();
            var input = $(li).children("input");
            var cat = {
                id: $(li).attr("id"),
                name: $(input).val()
            }
            $.ajax({
                type: "POST",
                url: burl + "/category/save",
                data: cat,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                },
                success: function (sms) {
                    if (sms > 0) {
                        $(li).attr("id", sms);
                        var str = "<a href='" + burl + "/sub1/" + sms + "'>" + cat.name + "</a>&nbsp;&nbsp;";
                        str += "<a href='#' class='text-success' onclick='edit(this,event)'><i class='fa fa-pencil'></i></a>&nbsp;";
                        str += "<a href='#' class='text-danger' onclick='rm(this,event)'><i class='fa fa-remove'></i></a>";
                        $(li).html(str);
                    }

                }
            });
        }
        function rm(obj, evt)
        {
            evt.preventDefault();
            var li = $(obj).parent();
            var id = $(li).attr("id");
            var o = confirm("តើអ្នកពិតជាចង់លុបមែនទេ?");
            if(o)
            {
                $.ajax({
                    type: "GET",
                    url: burl + "/category/delete/" + id,
                    success: function(sms){
                        if(sms>0)
                        {
                            li.remove();
                        }
                    }
                });
            }

        }
    </script>
@endsection