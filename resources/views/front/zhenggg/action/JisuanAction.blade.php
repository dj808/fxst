
<button class="btn btn-sm btn-primary fafang" data-id="{{$id}}"  data-toggle="modal"
        data-url="{{$url}}" data-target="#grid-modal-jisuan-{{$id}}">
    处理
</button>

<div class="modal fade" id="grid-modal-jisuan-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">结算</h4>
            </div>
            <div class="modal-body">
                <div style="height:400px;">

                    <div class="form-group" style="max-height: 150px;overflow: auto;">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover jisuans-table" style="display: none;" >
                                <tr class="head-fafang">
                                    <th>发放记录</th>
                                    <th>发放方式</th>
                                    <th>发放金额</th>
                                    <th>发放时间</th>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="form-group 1" style="overflow: hidden;">
                        <label for="" class="col-sm-2 control-label">未发金额</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" id="not_jie_money{{$id}}" class="form-control" disabled >
                            </div>
                        </div>
                    </div>
                        <form id="jiesuanform{{$id}}" method="post" action="{{$form_url}}" onsubmit="return jiesuan({{$id}})">
                            {{csrf_field()}}
                            <div class="form-group" style="overflow: hidden;">
                                <label for="" class="col-sm-2 control-label">发放方式</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" name="fafangtype{{$id}}" value="" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="overflow: hidden;">
                                <label for="" class="col-sm-2 control-label">发放金额</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" id="fafangmoney{{$id}}" name="fafangmoney{{$id}}" class="form-control" placeholder="输入 发放金额">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer" style="display: block;">
                                <div class="col-sm-8">
                                    <div class="btn-group pull-right">
                                        <button type="submit" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin '></i> 提交">提交</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <script>
                            function jiesuan(u_id){
                                var not_jie_money = $("#not_jie_money"+u_id).val();
                                var fafangmoney = $("#fafangmoney"+u_id).val()?$("#fafangmoney"+u_id).val():0;

                                if(fafangmoney > not_jie_money || fafangmoney == 0) {
                                    alert('金额不能为0或大于最大金额');
                                    $("#fafangmoney"+u_id).val('');
                                    return false;
                                } else {
                                    $("#jiesuanform"+u_id).submit();
                                }
                            }
                        </script>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
