@extends('layouts.main')
@section('content')
    <section class='banner_inner'>
        <div class='banner__img Innerbanner__img'>
            <img src="{{ asset('assets/images/inner11.png') }}" alt='' class='img__cover'>
        </div>
        <div class='container'>
            <div class='row'>
                <div class='col-lg col-md col-sm'>
                    <div class='Innerbanner__con'>
                        <h3>Product Gallery </h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="gallary">
        <div class="gall__bg gall__bg1">
            <img src="{{ asset('assets/images/flowers.png') }}" alt='' class='img__contain'>
        </div>
        <div class="gall__bg gall__bg2">
            <img src="{{ asset('assets/images/flowers.png') }}" alt='' class='img__contain'>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="sectionContent text-center">
                        <h3 class="heading">Our Gallery </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="Main__gallery">
            <div class="container">
                <div class="all-galleries-rows">
                    @foreach ($gallery_chunks as $key => $chunk)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="gallery_image">
                                            @php
                                                $gallery_0 = $galleries->where('id', $chunk[0])->first();
                                            @endphp
                                            @if ($gallery_0)
                                                <img src="{{ asset($gallery_0->img_path) }}" alt="">
                                            @endif
                                        </div>
                                        <div class="gallery_image">
                                            @php
                                                $gallery_1 = $galleries->where('id', $chunk[1])->first();
                                            @endphp
                                            @if ($gallery_1)
                                                <img src="{{ asset($gallery_1->img_path) }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="gallery_image gallery_image-alt">
                                            @php
                                                $gallery_2 = $galleries->where('id', $chunk[2])->first();
                                            @endphp
                                            @if ($gallery_2)
                                                <img src="{{ asset($gallery_2->img_path) }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="gallery_image">
                                            @php
                                                $gallery_3 = $galleries->where('id', $chunk[3])->first();
                                            @endphp
                                            @if ($gallery_3)
                                                <img src="{{ asset($gallery_3->img_path) }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="gallery_image">
                                            @php
                                                $gallery_4 = $galleries->where('id', $chunk[4])->first();
                                            @endphp
                                            @if ($gallery_4)
                                                <img src="{{ asset($gallery_4->img_path) }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="gallery_image gallery_image-alt gallery_image gallery_image-alt-2">
                                            @php
                                                $gallery_5 = $galleries->where('id', $chunk[5])->first();
                                            @endphp
                                            @if ($gallery_5)
                                                <img src="{{ asset($gallery_5->img_path) }}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>





    <!-- Footer -->
@endsection
@section('css')
    <style type="text/css">
        /*in page css here*/
    </style>
@endsection
@section('js')
    <script type="text/javascript">
        (() => {
            // Add Class On Even Rows in Gallery 
            let allGalleriesRows = document.querySelectorAll('.all-galleries-rows .row');
            allGalleriesRows.forEach((row, index) => {
                if (index % 2 !== 0) {
                    row.classList.add('even');

                    // Select images only for even rows
                    let allImgsInRow = row.querySelectorAll('img');

                    console.log(allImgsInRow.length);

                    if (allImgsInRow.length === 6) {
                        row.classList.add('flex-row-reverse');
                    }
                }
            });

        })()
    </script>
@endsection
