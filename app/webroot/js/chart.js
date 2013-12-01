$(function() {
	// hard-code color indices to prevent them from shifting as
	// countries are turned on/off
	var i = 0;
	$.each(datasets, function(key, val) {
		val.color = val.color;
		++i;
	});

	// insert checkboxes 
	var choiceContainer = $("#choices");
	$.each(datasets, function(key, val) {
		choiceContainer.append("<br/><input type='checkbox' name='" + key +
			"' checked='checked' id='id" + key + "'></input>" +
			"<label for='id" + key + "'>"
			+ val.label + "</label>");
	});

	choiceContainer.find("input").click(plotAccordingToChoices);

	$("<div id='tooltip'></div>").css({
		position: "absolute",
		display: "none",
		border: "1px solid #fdd",
		padding: "2px",
		"background-color": "#fee",
		opacity: 0.80
	}).appendTo("body");

	function plotAccordingToChoices() {
		var data = [];

		choiceContainer.find("input:checked").each(function () {
			var key = $(this).attr("name");
			if (key && datasets[key]) {
				data.push(datasets[key]);
			}
		});

		// Tooltip
		$("#placeholder").bind("plothover", function (event, pos, item) {
			if (item) {
				var x = item.datapoint[0].toFixed(0),
					y = item.datapoint[1].toFixed(0);

				$("#tooltip").html(item.series.label + ",<label><b>Referral " + y + "</b></label>")
					.css({top: item.pageY+10, left: item.pageX+10})
					.fadeIn(200);
			} else {
				$("#tooltip").hide();
			}
		});

		if (data.length > 0) {
			$.plot("#placeholder", data, {
				series: {
					lines: {
						show: true
					},
					points: {
						show: true
					}
				},
				grid: {
					hoverable: true
				},
				yaxis: {
					min: 0
				},
				xaxis: {
					tickDecimals: 0
				}
			});
		}
	}

	plotAccordingToChoices();
});