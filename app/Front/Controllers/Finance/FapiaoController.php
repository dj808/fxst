<?php


namespace App\Front\Controllers\Finance;


use App\Front\Extensions\Action\KaiPiaoAction;


use App\Models\Customer;
use App\Models\Department;
use App\Models\Input;

use App\Models\Menber;
use App\Models\Periodical;
use App\Models\PiaoLog;

use App\Zhenggg\Grid;
use App\Zhenggg\Layout\Content;
use Illuminate\Routing\Controller;

class FapiaoController extends Controller
{
    public function index()
    {
        return \Front::content(function (Content $content) {

            $content->header('发票');
            $content->description('管理');

            $content->body($this->grid());
        });
    }
    protected function grid()
    {
        return \Front::grid(Input::class, function (Grid $grid) {

            //grid model filters
            $grid->model()->where('user_id', '=', \Front::user()->user_id)->orderBy('id', 'desc');

            //grid columns
            $grid->column('customer', '客户')->display(function () {
                $customer_name = Customer::where('id', $this->c_id)->value('name');
                if ($customer_name) {
                    return '<a href=" ' . \Front::url('customer') . '/' . $this->c_id . '/edit/"> ' . $customer_name . '</a>';
                } else {
                    return $this->customer_name . '(已删除)';
                }
            });
            $grid->u_id('发行人')->display(function () {
                $menber_name = Menber::where('id', $this->u_id)->value('name');

                return $menber_name ? $menber_name : $this->menber_name . '(已删除)';
            });
            $grid->column('d_id', '部门')->display(function () {
                $department_name = Department::where('id', $this->d_id)->value('name');

                return $department_name ? $department_name : $this->department_name . '(已删除)';
            });
            $grid->p_id('报刊名称')->display(function () {
                $periodical_name = Periodical::where('id', $this->p_id)->value('name');

                return $periodical_name ? $periodical_name : $this->periodical_name . '(已删除)';
            });
            $grid->num('数量')->display(function () {
                return $this->num . '份';
            });
            $grid->p_amount('应付金额');
            $grid->piao_money('已开金额');
            $grid->column('not_piao_money', '未开金额')->display(function () {
                return ($this->p_amount - $this->piao_money);
            });
            $grid->column('fapiao', '发票号')->display(function () {
                $piao_logs =  PiaoLog::where('user_id', \Front::user()->user_id)
                    ->where('input_id',$this->id)
                    ->pluck('name', 'id');
                $html = '';
                foreach ($piao_logs as $piao_log) {
                    $html .= $piao_log .',';
                }
                return $html;
            });
            $grid->piao_status('开票状态')->display(function () {
                return trans('app.piao_status.' . $this->piao_status . '');
            });

            //grid actions
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
                $actions->disableEdit();

                $actions->append(new KaiPiaoAction($actions->getKey(),$actions->row->piao_status));

            });

            //grid tools
            $grid->disableCreation();
            $grid->tools(function ($tools) {
                $tools->batch(function ($batch) {
                    $batch->disableDelete();
                });
            });

            //grid filters
            $grid->filter(function($filter){

                $filter->disableIdFilter();

                $filter->is('piao_status', '开票状态')->select(trans('app.piao_status'));
                $filter->like('customer_name', '客户');
                $filter->is('d_id', '所属部门')->select(Department::selectOptionsForNoroot());

                $filter->where(function ($query) {
                    $input = $this->input;
                    $query->whereHas('fapiaos', function ($query) use ($input) {
                        $query->where('fapiaohao', 'like', "%{$input}%");
                    });
                }, '发票号');
            });
        });
    }
}