@extends('layouts.frontLayout.front_design') @section('customStyle')
<style>
    body {
        font-family: "Open Sans", sans-serif;
        font-weight: 300;
    }
    .tabs {
        /* max-width: 640px; */
        margin: 0 auto;
        padding: 0 20px;
    }
    #tab-button {
        display: table;
        table-layout: fixed;
        width: 100%;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    #tab-button li {
        display: table-cell;
        width: 20%;
    }
    #tab-button li a {
        display: block;
        padding: 0.5em;
        background: #eee;
        border: 1px solid #ddd;
        text-align: center;
        color: #000;
        text-decoration: none;
    }
    #tab-button li:not(:first-child) a {
        border-left: none;
    }
    #tab-button li a:hover,
    #tab-button .is-active a {
        border-bottom-color: transparent;
        background: #fff;
    }
    .tab-contents {
        padding: 0.5em 0 1em;
        border: 1px solid #ddd;
    }

    .tab-button-outer {
        display: none;
    }
    .tab-contents {
        margin-top: 20px;
    }
    @media screen and (min-width: 768px) {
        .tab-button-outer {
            position: relative;
            z-index: 2;
            display: block;
        }
        .tab-select-outer {
            display: none;
        }
        .tab-contents {
            position: relative;
            top: -1px;
            margin-top: 0;
        }
    }
</style>
@endsection @section('content');

<section>
    <section id="form">
        <!--form-->
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Account</a></li>
                    <li class="active">Order History</li>
                </ol>
            </div>
            <div class="col-md-12">
                <div class="tabs">
                    <div class="tab-button-outer">
                        <ul id="tab-button">
                            <li><a href="{{url('/account')}}">Account Infomation</a></li>
                            <li><a href="#tab02">Order History</a></li>
                        </ul>
                    </div>
                    <div class="tab-select-outer">
                        <select id="tab-select">
                            <option value="#tab01">Tab 1</option>
                            <option value="#tab02">Tab 2</option>
                        </select>
                    </div>

                    <div id="tab01" class="tab-contents">
                        <h2>Tab 1</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius quos
                            aliquam consequuntur, esse provident impedit minima porro! Laudantium
                            laboriosam culpa quis fugiat ea, architecto velit ab, deserunt rem
                            quibusdam voluptatum.
                        </p>
                    </div>
                    <div id="tab02" class="tab-contents">
 

                        <table
                            id="example"
                            class="table table-striped table-bordered"
                            style="width: 100%;"
                        >
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Payment Method</th>
                                    <th>Created On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->payment}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->order_status}}</td>
                                    <td>
                                        <a href="{{url('/account/orders/'.$item->id)}}">
                                            View Details
                                        </a>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/form-->
</section>
@endsection @section('extraJS')
<script>
    $(function () {
        var $tabButtonItem = $("#tab-button li"),
            $tabSelect = $("#tab-select"),
            $tabContents = $(".tab-contents"),
            activeClass = "is-active";

        $tabButtonItem.last().addClass(activeClass);
        $tabContents.not(":last").hide();

        $tabButtonItem.find("a").on("click", function (e) {
            var target = $(this).attr("href");

            $tabButtonItem.removeClass(activeClass);
            $(this).parent().addClass(activeClass);
            $tabSelect.val(target);
            $tabContents.hide();
            $(target).show();
            e.preventDefault();
        });

        $tabSelect.on("change", function () {
            var target = $(this).val(),
                targetSelectNum = $(this).prop("selectedIndex");

            $tabButtonItem.removeClass(activeClass);
            $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
            $tabContents.hide();
            $(target).show();
        });
    });
</script>
@endsection
