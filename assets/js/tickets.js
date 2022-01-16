$("#newTicketFromOpen").click(function() {
	    $("#newTicketModal").modal('show');
	    var url =BASE_URL+'Tickets/createTicket';
		$.ajax({
			    type: "GET",
			    url: url,
			    success: function(data)
			    {
			      $("#createTicketFromData").html(data);
			    },
			    error: function (error) {
				   $("#newTicketModal").modal('hide');
			    }
		});
});

$(document).ready(function(){
		$('#example1').DataTable({
			"order": [[ 4, "desc" ]]
		});
});

getTickets();

//setInterval(getTickets, 1000);

function getTickets(){
	    var url =BASE_URL+'Tickets/getTickets/'+status_ticket;
		$.ajax({
			    type: "GET",
			    url: url,
			    success: function(data)
			    {
			      $("#TicketData").html(data);
			    },
			    error: function (error) {
			    }
		});
}

function getChats(ticket_id){
	    $("#message-view-modal").modal('show');
	    var url =BASE_URL+'Tickets/getChat/'+ticket_id;
		$.ajax({
			    type: "GET",
			    url: url,
			    success: function(data)
			    {
			      $("#TicketChatData").html(data);
			    },
			    error: function (error) {
			    }
		});
}

