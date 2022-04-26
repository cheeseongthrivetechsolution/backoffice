//Department page function declaration
const Department = {
  getDepartmentList : function(){
    var params = {
      lang: config.lang,
      token: Common.getToken()
    };
    var result;
    $.ajax({
        url: API_ENDPOINT + "department/getDepartmentList.php",
        type: "GET",
        data: params,
        success: function(data) {
            data = Common.parseObj(data);
            Common.skipIndex(data);
            if (data.code == 200) {
              // Department.drawTable(data.row);
            }
        },
        error: function(data) {
          console.log(data);
        }
    });
  }
}



$(function() {
  Department.getDepartmentList();
  $("#addForm").change();
  $("#addBtn").on("click", function(){

    window.parent.$('#asd').modal('show');
  })
});
