<script type="text/javascript">
	//$('#my-select').multiSelect();
	$('a#a').click({p1:_o_t_a(<?php echo json_encode($music); ?>),p2:_o_t_a(<?php echo json_encode($music); ?>)},set);
	function set(e) {
		e.preventDefault();
		alert(e.data.p1.length);
		console.log(e.data.p1);
		return false;
	}
	function _o_t_a(arg) {
		var dt = [[],[]];
		for (var i in arg) {
			var item = arg[i];
			var outer = [];
			if (typeof item === "object") {
				for (var j in item) {

					var temp = [];
					temp[i] = item[j];
					/*temp.push(item[j]);
					temp[j] = item[]*/
					outer.push(temp);
					//dt.push(temp);
					//dt[i][j] = item[j];
					//alert(j);
				}
			}
			if (outer.length) {
				dt.push(outer);
			}
		}
		return dt;
	}
</script>