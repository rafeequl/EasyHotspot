jQuery(document).ready(function($) {
	$("#restore_default").click(function(){
		$("#radiusserver1").val("127.0.0.1");
		$("#radiusserver2").val("127.0.0.1");
		$("#radiussecret").val("easyhotspot");
		$("#dhcpif").val("eth1");
		$("#uamserver").val("https://192.168.182.1/hotspotlogin.cgi");
		$("#uamsecret").val("easyhotspot");
		$("#uamhomepage").val("https://192.168.182.1/hotspotlogin.cgi");
		$("#uamallowed").val("192.168.182.1");
		$("#net").val("192.168.182.0/24");
	});
});