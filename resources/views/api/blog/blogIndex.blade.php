@extends('default.master')
@section('body')
    <div>
        <div>
            <form id="frmTourDetail" name="frmTourDetail">
                <input type="hidden" name="contentId" />
            </form>
            <form id="frmTour" name="frmTour" method="post">
                <select name="contentTypeId">
                    @foreach (config('constants.contentTypeId') as $k => $v)
                        <option value="{{ $k }}" {{ getSelectedText($params['contentTypeId'], $k) }}>{{ $v }}</option>
                    @endforeach
                </select>

                <select name="arrange">
                    @foreach (config('constants.arrange') as $k => $v)
                        <option value="{{ $k }}" {{ getSelectedText($params['arrange'], $k) }}>{{ $v }}</option>
                    @endforeach
                </select>

                <button id="btnSubmit">검색</button>

            </form>
        </div>
        @php
            include app()->resourcePath('views/api/common/title_done.php');
            //$done_title = explode("|", $tour_title_done);
        @endphp

        <div id="list">
            <ul>
                @foreach ($tour as $v)
                    @php
                        $items = $data[$v]['items']['item'];
                    @endphp
                    @foreach ($items as $item)
                        <li>
                            <dl>
                                @if(strpos($tour_title_done, $item['title']) !== false)
                                    <dt data-seq="{{ $item['contentid'] }}">{{ $item['title'] . " [완]" }}</dt>
                                @else
                                    <dt data-seq="{{ $item['contentid'] }}">{{ $item['title'] }}</dt>
                                @endif

{{--                                <dd>{{ getParseDate($item['eventstartdate'], "Y.m.d") . " ~ " . getParseDate($item['eventenddate'], "Y.m.d") }}</dd>--}}
                                <dd>{{ getArrayValue('tel', $item) }}</dd>
                                <dd>{{ getParseDate(getArrayValue('createdtime', $item), 'Y-m-d H:i:s') . " ~ " . getParseDate(getArrayValue('modifiedtime', $item), 'Y-m-d H:i:s') }}</dd>
                                <dd>{{ getArrayValue('readcount', $item, 0) }}</dd>
                            </dl>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
        @collect($pages)

        {{--{{ "현재 페이지는 ".$pages->get('pageNo') }}--}}
        {{--{{ "페이지당 블 ".$pages->get('PagePerBlock') }}--}}
        {{--{{ "현재 블록은 ".$pages->get('nowBlock') }}--}}
        {{--{{ "현재 블록의 시작 페이지는 ".$pages->get('s_page') }}--}}
        {{--{{ "현재 블록의 끝 페이지는 ".$pages->get('e_page') }}--}}
        {{--{{ "총 페이지는 ".$pages->get('pageNum') }}--}}
        {{--{{ "총 블록은 ".$pages->get('blockNum') }}--}}

        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($pages->get('nowBlock') != 1)
                        <li class="page-item"><a class="page-link" href="{{ route('api.blog.blogIndex') }}?pageNo={{ $pages->get('s_page')-1 ."&" . $pageParams }} }}">Previous</a></li>
                    @endif
                    @for ($p=$pages->get('s_page'); $p<=$pages->get('e_page'); $p++)
                        <li class="page-item {{ getSelectedText($pages->get('pageNo'), $p, 'active') }}"><a class="page-link" href="{{ route('api.blog.blogIndex') }}?pageNo={{ $p . "&" . $pageParams }}">{{ $p }}</a></li>
                    @endfor
                    @if ($pages->get('blockNum') != $pages->get('nowBlock'))
                        <li class="page-item"><a class="page-link" href="{{ route('api.blog.blogIndex') }}?pageNo={{ $pages->get('e_page')+1 . "&" . $pageParams }}">Next</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@stop
@section('css')
    @parent

    <style>
        #list li dt {
            cursor:pointer;
        }
    </style>
@stop

@section('add_js')
    <script>
        $("#list li dt").on("click", function () {
            $('input[name=contentId]').val($(this).data('seq'));

            $("#frmTourDetail")
                .attr('method', 'post')
                .attr('action', "{{ route('api.blog.result') }}")
                .submit();
        })
    </script>
@stop