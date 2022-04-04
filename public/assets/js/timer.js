$(document).ready(function(){
    $('.checkIn').click(function(){
        var min = $(this).parents('td').siblings('.mins');
        var hr = $(this).parents('td').siblings('.hrs');
        var value = parseInt(min.text(), 10);
        var value2 = parseInt(hr.text(), 10);
        var myInterval = setInterval(function(){
            value++;
            min.text(value);
            if(min.text() > 59)
            {
                value = 0;
                min.text(0);
                value2++;
                hr.text(value2);
            }
        }, (100));
        $(this).attr('disabled',true);
        $(this).siblings('.checkOut').attr('disabled',false);

        $('.checkOut').click(function(){
            var checkOut = $(this);
            var minText = min.text();
            var hrText = hr.text();
            var ids = checkOut.parents('td').siblings('.ids').text();
            var overTime;
            var newHr;
            if(hrText > 8 || hrText == 8)
            {
                newHr = hrText - 8;
                overTime = newHr+':'+minText+':00';
            }
            else{
                overTime = '00:00:00';
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "overtime",
                type: "POST",
                data: { id : ids, min : minText, hr : hrText, over : overTime},
                success: function(res){
                    console.log(res);
                    clearInterval(myInterval);
                    min.text("00");
                    hr.text("00");
                    checkOut.attr('disabled',true);
                    checkOut.siblings('.checkIn').attr('disabled',false);
                }
            })
        });
    });

})

