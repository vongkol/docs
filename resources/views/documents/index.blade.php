@extends("layouts.document")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong id="title"></strong><button type="button" class="btn btn-link" data-toggle="modal" data-target="#docModal" id="btnUpload">upload</button>
                </div>
                <div class="card-block">
                {{csrf_field()}}
                    <input type="hidden" id="cid" value="0">
                    <input type="hidden" id="ctype" value="0">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>លេខ ID</th>
                            <th>ចំណងជើង</th>
                            <th>បរិយាយ</th>
                            <th>ឈ្មោះឯកសារ</th>
                            <th>សកម្មភាព</th>
                        </tr>
                        </thead>
                        <tbody id="data">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal fade" id="docModal" tabindex="-1" role="dialog" aria-labelledby="docModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="docModalTitle">Upload Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="form-group row">
                                <label for="doc_title" class="control-label col-sm-3">ចំណងជើង</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="doc_title" name="doc_title">
                                    <input type="hidden" id="doc_id" value="0">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="doc_file_name" class="control-label col-sm-3">ឈ្មោះឯកសារ<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="doc_file_name" name="doc_file_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="control-label col-sm-3">បរិយាយ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="description" name="description">
                                    <input type="hidden" id="doc_id" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p id="sms" class="text-danger text-center"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveDoc()">Upload</button>
                    <button type="button" class="btn btn-secondary btn-danger" data-dismiss="modal" onclick="clearDoc()">បោះបង់</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#j1_1 a").trigger("click");
            $("#title").html($("#j1_1 a").text());
            $("#cid").val($("#j1_1").attr("cat-id"));
            $("#ctype").val($("#j1_1").attr("cat-type"));
            getDocuments($("#j1_1").attr("cat-id"), $("#j1_1").attr("cat-type"));

            $('#explorer').on("select_node.jstree", function (e, data) {
                var str = "li#" + data.node.id;
                var catid = $(str).attr("cat-id");
                var cattype = $(str).attr("cat-type");
               $("#title").html(data.node.text);
               $("#cid").val($(str).attr("cat-id"));
               $("#ctype").val($(str).attr("cat-type"));
               getDocuments(catid, cattype);
            });
        });
      function getDocuments(catid, cattype) {
          $.ajax({
              type: "POST",
              url: burl + "/document/get",
              data: {category_id: catid, category_type: cattype},
              beforeSend: function (request) {
                  return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
              },
              success: function(data)
              {
                  var tr = "";
                  for(var i=0;i<data.length;i++)
                  {
                      tr += "<tr id='" + data[i].id + "'>";
                      tr += "<td>" + data[i].id + "</td>";
                      tr += "<td>" + data[i].title + "</td>";
                      tr += "<td>" + data[i].description + "</td>";
                      tr += "<td><a href='" + upload_url + "/" + data[i].file_name +"' target='_blank'>" + data[i].file_name + "</a></td>";
                      tr += "<td>" + "<a href='#' onclick='editDoc(this,event)'>Edit</a>&nbsp;<a href='#' class='text-danger' onclick='rmDoc(this,event);'>Delete</a>" + "</td>";

                      tr += "</tr>";
                  }
                  $("#data").html(tr);
              }
          });
      }
      function rmDoc(obj, evt) {
          evt.preventDefault();
          var tr = $(obj).parent().parent();
          var id = $(tr).attr("id");
          var o = confirm("តើអ្នកពិតជាចង់លុបមែនទេ?");
          if(o)
          {
              $.ajax({
                  type: "GET",
                  url: burl + "/document/delete/" + id,
                  success: function(sms)
                  {
                      if(sms)
                      {
                          tr.remove();
                      }
                  }
              });
          }
      }
        function saveDoc () {
            var o = confirm('Do you want to save?');
            if(o)
            {
                var file_data = $('#doc_file_name').prop('files')[0];
                var form_data = new FormData();
                form_data.append('doc_file_name', file_data);
                form_data.append("doc_title", $("#doc_title").val());
                form_data.append("description", $('#description').val());
                form_data.append("category_id", $("#cid").val());
                form_data.append("type", $("#ctype").val());
                form_data.append("id", $("#doc_id").val());
                $("#sms").html("<img src='" + asset + "/ajax-loader.gif" + "'>");
                $.ajax({
                    type: 'POST',
                    url:burl + '/document/save',
                    data: form_data,
                    type: 'POST',
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData: false,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                    },
                    success:function(sms){
                        if($("#doc_id").val()>0)
                        {
                            var str = "#"+ $("#doc_id").val();
                            $("#sms").html("ឯកសារត្រូវបានកែប្រែដោយជោគជ័យ។");
                            $("#doc_id").val("0");
                            $("#doc_file_name").val("");
                            sms = JSON.parse(sms);
                            var tr = $(str);
                            var tds = $(tr).children("td");
                            $(tds[1]).html(sms.title);
                            $(tds[2]).html(sms.description);
                            $(tds[3]).html("<a href='" + upload_url + "/" + sms.file_name + "' target='_blank'>" + sms.file_name + "</a>");
                        }
                        else{
                            if(sms=="No")
                            {
                                alert("សូមជ្រើសរើសឯកសារដើម្បីបង្ហោះចូល!");
                            }
                            else{
                                $("#sms").html("ឯកសារថ្មីត្រូវបានបញ្ចូលដោយជោគជ័យ។");
                                $("#doc_title").val("");
                                $("#description").val("");
                                $("#doc_id").val("0");
                                $("#doc_file_name").val("");
                                var tr = "";
                                sms = JSON.parse(sms);
                                tr += "<tr id='" + sms.id + "'>";
                                tr += "<td>" + sms.id + "</td>";
                                tr += "<td>" + sms.title + "</td>";
                                tr += "<td>" + sms.description + "</td>";
                                tr += "<td><a href='" + upload_url + "/" + sms.file_name + "' target='_blank'>" + sms.file_name + "</a></td>";
                                tr += "<td>" + "<a href='#' onclick='editDoc(this,event)'>Edit</a>&nbsp;<a href='#' class='text-danger' onclick='rmDoc(this,event);'>Delete</a>" + "</td>";
                                tr += "</tr>";
                                if($("#data tr").length>0)
                                {
                                    $("#data tr:last-child").after(tr);
                                }
                                else{
                                    $("#data").html(tr);
                                }
                            }
                        }

                    },
                });
            }
        }
        function clearDoc() {
            $("#sms").html("");
            $("#doc_title").val("");
            $("#description").val("");
            $("#doc_id").val("0");
            $("#doc_file_name").val("");
        }
        function editDoc(obj, evt) {
            evt.preventDefault();
            var tr = $(obj).parent().parent();
            var tds = $(tr).children("td");
            var doc = {
                id: $(tr).attr("id"),
                doc_title: $(tds[1]).html(),
                description: $(tds[2]).html()
            };
           $("#doc_id").val(doc.id);
           $("#doc_title").val(doc.doc_title);
           $("#description").val(doc.description);
           $("#btnUpload").trigger("click");
        }
    </script>

@endsection