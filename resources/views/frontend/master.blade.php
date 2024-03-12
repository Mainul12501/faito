<!DOCTYPE html>
<html>

<head>
    @include('frontend.includes.assets.meta')
    <title>Faito</title>

    <link rel="icon" href="{{ asset('/') }}frontend/assets/contents/Y1nunJilpj.png">

    <!--Style-->
    <!--build:css css/styles.min.css-->

    @include('frontend.includes.assets.css')
    <!--endbuild-->

    <!--js-->
    <!--build:js js/main.min.js -->

    <script>
        const BASEURL = "{!! url('/') !!}" + '/';
        function changeLocalLang(lang){
            event.preventDefault();
            // window.location = BASEURL+"change-language/"+lang ;
            $.ajax({
                url: BASEURL+"change-language/"+lang,
                method: "GET",
                success: function (response) {
                    // var previousUrl = response.previousUrl;
                    // if (previousUrl.includes("/en/") || previousUrl.includes("/bn/"))
                    // {
                    //     if (response.lang == 'bn')
                    //     {
                    //         window.location = BASEURL+response.lang+'/'+previousUrl.split('/en/')[1];
                    //     } else if (response.lang == 'en')
                    //     {
                    //         window.location = BASEURL+response.lang+'/'+previousUrl.split('/bn/')[1];
                    //     }
                    // } else {
                    //     location.reload();
                    // }
                    location.reload();
                }
            })
        }
    </script>
    @include('frontend.includes.assets.script')
    <!--endbuild-->
</head>
<body>

<!-- header -->
@include('frontend.includes.header')
<!-- end of header --><!-- middle -->
<!-- middle -->

@yield('body')

<!-- end of middle -->
<!-- end of middle -->
<!--Footer -->
@include('frontend.includes.footer')
<!--end of Footer -->
</body>

</html>
