<title>{{$header['title']}}</title>
<meta name="description" content="{{$header['description']}}">
<meta name="keywords" content="{{$header['keywords']}}">
<meta property="og:description" content="{{$header['description']}}">
<meta property="og:url" content="{{url()->full()}}">
<meta property="og:site_name" content="{{$company->Name}}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{$header['title']}}">
<meta property="og:image" content="{{asset($header['image'])}}">
<meta property="og:image:secure_url" content="{{asset($header['image'])}}">
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="{{$company->Name}}" />
<meta name="twitter:title" content="{{$header['title']}}" />
<meta name="twitter:description" content="{{$header['description']}}" />
<meta name="twitter:image" content="{{asset($header['image'])}}" />
<meta name="twitter:image:alt" content="{{$header['description']}}" />
