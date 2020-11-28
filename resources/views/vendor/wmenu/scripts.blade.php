<script>
	var menus = {
		"oneThemeLocationNoMenus" : "",
		"moveUp" : "Переместить вверх",
		"moveDown" : "Переместить вниз",
		"moveToTop" : "Переместить верх",
		"moveUnder" : "Двигаться под %s",
		"moveOutFrom" : "Из-под  %s",
		"under" : "Под %s",
		"outFrom" : "Из %s",
		"menuFocus" : "%1$s. Элемент меню %2$d из %3$d.",
		"subMenuFocus" : "%1$s. подменю %2$d родителя %3$s."
	};
	var arraydata = [];
	var addcustommenur= '{{ route("haddcustommenu") }}';
	var updateitemr= '{{ route("hupdateitem")}}';
	var generatemenucontrolr= '{{ route("hgeneratemenucontrol") }}';
	var deleteitemmenur= '{{ route("hdeleteitemmenu") }}';
	var deletemenugr= '{{ route("hdeletemenug") }}';
	var createnewmenur= '{{ route("hcreatenewmenu") }}';
	var csrftoken="{{ csrf_token() }}";
	var menuwr = "{{ url()->current() }}";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': csrftoken
		}
	});
</script>
<script type="text/javascript" src="{{asset('vendor/harimayco-menu/scripts.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/harimayco-menu/scripts2.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/harimayco-menu/menu.js')}}"></script>
