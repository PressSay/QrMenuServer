@props(['category', 'url'])
<a href="{{ str_replace('&amp;', '&', $url) }}"
    class="btn btn-lg sm:w-96 w-10/12 mx-2 my-3 rounded-tr-xlarge rounded-bl-xlarge shadow-xl text-sm sm:text-base"
    style="background-color: #DAE7CA; color: #3C691B;">{{ $category }}</a>
