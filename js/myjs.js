      // 訂票系統
    // 選擇電影 下拉式選單 ajax取得資料
    $.post("api.php?do=chmovie", function (re){
      $('#chmovie').html(re);
    })
    //  日期計算函式
    function getday(add){
      let today = new Date;
      let gg = today.getDate();//算今天幾號
      today.setDate(gg + add);//設定今天日期為 今日號+add
      let yy = today.getFullYear();
      let mm = today.getMonth() + 1;
      let dd = today.getDate();
      if(mm<10) mm=`0${mm}`;
      if(dd<10) dd=`0${dd}`;
      return `${yy}-${mm}-${dd}`;
    }
    //選擇日期 下拉式選單
    $('#chdate').html(`
      <option value="">請選擇場次</option>
      <option value=${getday(0)}>${getday(0)}</option>
      <option value=${getday(1)}>${getday(1)}</option>
      <option value=${getday(2)}>${getday(2)}</option>
      <option value=${getday(3)}>${getday(3)}</option>
      <option value=${getday(4)}>${getday(4)}</option>
      <option value=${getday(5)}>${getday(5)}</option>
      <option value=${getday(6)}>${getday(6)}</option>
      <option value=${getday(7)}>${getday(7)}</option>
    `);
    //  選擇場次 下拉式選單
     function getval(){
        let movie = $('#chmovie').val();
        let date = $('#chdate').val();
        // console.log(movie,date);
        $.post("api.php?do=booking",{movie,date},function (re){
          $('#chtime').html(re);
        });

      }