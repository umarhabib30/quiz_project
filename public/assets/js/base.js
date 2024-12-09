var baseJS = {
  site_url: "",
  current_url: "",
  csrf_token: "",
  cdn: "https://dixeam.com/cdn",
  langCDN: "https://cdn.statically.io/gh/link2qaiser/basejs/master/3.0/lang/en.js",
  lang: {},
  loadScript: function(url, callback) {
    jQuery.ajax({
      url: url,
      dataType: "script",
      success: callback,
      async: true,
    });
  },
  loadCSS: function(url, media, callback) {
    jQuery(document.createElement("link")).attr({
      href: url,
      media: media || "screen",
      type: "text/css",
      rel: "stylesheet",
    }).appendTo("head").on("load", callback);
  },
  afterAajaxCall: function(status, res, selector) {
    if (status == "success") {
      if (res.flag == true) {
        try {
          baseJS.notification.showSucess(res.msg);
        } catch (e) {}
      }
      if (res.flag == false) {
        try {
          baseJS.notification.showError(res.msg);
        } catch (e) {}
      }
      let afteAction = $(selector).attr("data-action-after");
      if (afteAction == "close") {
        $("#data_modal").modal("hide");
      } else if (afteAction == "reload") {
        window.location.reload();
      } else if (afteAction == "redirect") {
        window.location.href = res.url;
      } else {
        try {
          $("." + remvove).remove();
        } catch (err) {}
      }
    } else if (status == "error") {
      try {
        baseJS.notification.showError(res.msg);
      } catch (e) {}
    }
  },
  slugify: function(txt_src) {
    var output = txt_src.replace(/[^a-zA-Z0-9]/g, " ").replace(/\s+/g, "-").toLowerCase();
    if (output.charAt(0) == "-") output = output.substring(1);
    var last = output.length - 1;
    if (output.charAt(last) == "-") output = output.substring(0, last);
    return output;
  },
  init: function(param) {
    baseJS.loadScript(baseJS.langCDN, function() {
      baseJS.lang = lang;
      baseJS.loadLibs(param);
    });
  },
  loadLibs: function(param) {
    baseJS.site_url = param.site_url;
    baseJS.current_url = param.current_url;
    baseJS.csrf_token = $('meta[name="csrf-token"]').attr("content");
    if (param.notif !== undefined) {
      baseJS.notification.init(param.notif);
    }
    if (param.imasking !== undefined) {
      baseJS.inputMasking.init();
    }
    if (param.select2 !== undefined) {
      baseJS.select2.init();
    }
    baseJS.ajaxModel.init();
    baseJS.editable.init();
    baseJS.submitProblem.init();
    baseJS.bulkAction.init();
    baseJS.formValidation.init();
  },
  select2: {
    init: function() {
      baseJS.loadScript(baseJS.cdn + "/plugins/select2/js/select2.min.js", baseJS.select2.customSelect2);
      baseJS.loadCSS(baseJS.cdn + "/plugins/select2/css/select2.min.css");
    },
    customSelect2: function() {
      $('[data-s2="true"]').each(function(index) {
        $(this).select2();
      });
      $('[data-s2-ajax="true"]').each(function(index) {
        var placeholder = $(this).attr("data-placeholder");
        var dataUrl = $(this).attr("data-url");
        $(this).select2({
          placeholder: placeholder,
          allowClear: true,
          ajax: {
            url: dataUrl,
            dataType: "json",
            processResults: function(data) {
              return {
                results: data,
              };
            },
          },
          minimumInputLength: 1,
        });
      });
    },
    initModal: function() {
      $('[data-s2="true"]').select2({});
      $('[data-s2-ajax="true"]').each(function(index) {
        var placeholder = $(this).attr("data-placeholder");
        var dataUrl = $(this).attr("data-url");
        $(this).select2({
          placeholder: placeholder,
          allowClear: true,
          ajax: {
            url: dataUrl,
            dataType: "json",
            processResults: function(data) {
              return {
                results: data,
              };
            },
          },
          minimumInputLength: 1,
        });
      });
    },
  },
  inputMasking: {
    init: function() {
      baseJS.loadScript(baseJS.cdn + "/plugins/input-masking/jquery.inputmask.min.js", baseJS.inputMasking.customMasking);
    },
    customMasking: function() {
      $(document).on("keypress", '[data-mask="no-space"]', function(event) {
        if (event.keyCode == 32) {
          return false;
        }
      });
      $(document).on("keyup", '[data-mask="slugify"]', function(event) {
        let val = $(this).val();
        let target = $(this).attr("data-target");
        $(target).val(baseJS.slugify(val));
      });
      $("[data-mask]").each(function(index) {
        let mask = $(this).attr("data-mask");
        let prefix = $(this).attr("data-prefix");
        let isNeg = $(this).attr("data-negtive");
        let isPoint = $(this).attr("data-point");
        let format = $(this).attr("data-format");
        let placeholder = $(this).attr("data-placeholder");
        if (mask == "price") {
          $(this).inputmask("decimal", {
            prefix: prefix + " ",
            radixPoint: ".",
            digits: 2,
            autoGroup: true,
            groupSeparator: ",",
            allowMinus: false,
          });
        }
        if (mask == "decimal") {
          var obj = {};
          if (isNeg == "false") obj["allowMinus"] = false;
          if (isPoint == "false") obj["digits"] = "0";
          obj["placeholder"] = placeholder;
          $(this).inputmask("decimal", obj);
        }
        if (mask == "year") {
          $(this).inputmask("9999");
        }
        if (mask == "phone") {
          $(this).inputmask(format);
        }
        if (mask == "datetime") {
          $(this).inputmask("datetime", {
            inputFormat: format
          });
        }
        if (mask == "uppercase") {
          $(this).css("text-transform", "uppercase");
        }
        if (mask == "lowercase") {
          $(this).css("text-transform", "lowercase");
        }
      });
    },
  },
  notification: {
    init: function(param) {
      if (param.type == "toastr") {
        baseJS.notification.toaster(param.options);
      }
    },
    toaster: function(options) {
      baseJS.loadScript(baseJS.cdn + "/plugins/toastr/toastr.min.js");
      baseJS.loadCSS(baseJS.cdn + "/plugins/toastr/toastr.min.css");
    },
    showSucess: function(msg) {
      toastr["success"](msg, "Completed!");
    },
    showInfo: function(msg) {
      toastr["info"](msg, "Info!");
    },
    showWarning: function(msg) {
      toastr["warning"](msg, "Warning!");
    },
    showError: function(msg) {
      toastr["error"](msg, "Error!");
    },
  },
  formValidation: {
    init: function() {
      $(document).on("keyup", "input[type=text], input[type=password], textarea", function(event) {
        let val = $(this).val().trim();
        let req = $(this).attr("data-required");
        if (val == "") {
          if (val == "" && req != undefined) {
            $(this).addClass("border-danger");
            if (!$(this).next("small").length) {
              $(this).after('<small class="text-danger">This field is required</small>');
            }
          }
        } else {
          console.log(val);
          $(this).removeClass("border-danger");
          $(this).next("small").remove();
        }
      });
    },
    validateEmail: function(email) {
      const validateEmail = (email) => {
        return String(email).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
      };
    },
    validate: function(dom) {
      var inputs = $(dom +
        " input[type=text]," +
        dom +
        " textarea," +
        dom +
        " select," +
        dom +
        " input[type=password]" +
        dom +
        " input[type=checkbox]");
      var res = {};
      res.flag = true;
      inputs.each(function() {
        let val = $(this).val().trim();
        let req = $(this).attr("data-required");
        var i = 0;
        if (val == "" && req != undefined) {
          if (i == 0) this.focus();
          i++;
          res.flag = false;
          $(this).addClass("border-danger");
          if (!$(this).next("small").length) {
            $(this).after('<small class="text-danger">This field is required</small>');
          }
        }
      });
      return res;
    },
  },
  voiceInout: function() {
    $(document).on("click", "#voice-input", function(e) {
      let target = $(this).attr("data-target");
      let lang = $(this).attr("data-lang");
      $(this).attr("placeholder", "listing...");
      if (window.hasOwnProperty("webkitSpeechRecognition")) {
        var recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.interimResults = false;
        recognition.lang = lang;
        recognition.start();
        recognition.onresult = function(e) {
          document.getElementById(target).value = e.results[0][0].transcript;
          recognition.stop();
        };
        recognition.onerror = function(e) {
          recognition.stop();
        };
      }
    });
  },
  submitProblem: {
    modal: "",
    init: function() {
      baseJS.submitProblem.modal = `
      <div class="modal fade" id="submitProblemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Submit Problem</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <form action="#">
      <div class="modal-body">
      <div class="form-group">
      <label for="problem">Problem</label>
      <textarea  class="form-control" id="problem" name="problem"></textarea>
      </div>
      <div class="form-group">
      <label for="problem">Link</label>
      <input type="text" class="form-control" id="url" name="url" readonly value="` +
      window.location.href +
      `" />
      </div>
      <div class="form-group">
      <label for="problem">Screenshot</label>
      <img src="{==IMAGEURL==}" >
      <input type="hidden" class="form-control" id="screenshot" name="screenshot" value="" />
      </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary btn-sm save" >` +
      baseJS.lang.SAVE_CHANGES +
      `</button>
      </div>
      </form>
      </div>
      </div>
      </div>
      `;
      let container = "#submitProblem";
      $(container).append('<a class="button" href="javascript:void(0);">Submit Problem</a>');
      var modal = baseJS.submitProblem.modal;
      $(document).on("click", container + " .button", function(event) {
        html2canvas(document.querySelector("body")).then((canvas) => {
          let screenshot = canvas.toDataURL();
          modal = modal.replace("{==IMAGEURL==}", screenshot);
          $(container).append(modal);
          $("#submitProblemModal").modal("show");
          $(container + " #screenshot").val(screenshot);
        });
      });
      $(document).on("click", container + " .save", function(event) {
        if ($(container + " #problem").val() == "") {
          $(container + " #problem").focus();
          return;
        }
        let link = window.location.href;
        $.ajax({
          type: "POST",
          contentType: false,
          cache: false,
          processData: false,
          dataType: "json",
          url: $(container).attr("data-action"),
          data: new FormData($(container + " form")[0]),
          success: function(res) {
            $("#submitProblemModal .modal-body").html("<p>" + baseJS.lang.ProHBS + "</p>");
            $("#submitProblemModal .save").remove();
          },
        });
      });
    },
  },
  ajaxModel: {
    init: function() {
      $(document).ready(function() {
        $("body").after(`
          <div class="modal modal-blur fade" id="data_modal" role="dialog" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg all-modals">
          <div class="modal-content"></div>
          </div>
          </div>
          `);
        $(document).on("click", '[data-action="data_modal"]', function(e) {
          let url = $(this).attr("data-url");
          baseJS.ajaxModel.loadModal(url);
        });
      });
      $(document).on("submit", 'form[data-action="make_ajax"]', function(e) {
        that = this;
        e.preventDefault();
        baseJS.ajaxModel.makeAjax(that);
        return false;
      });
      $(document).on("submit", 'form[data-action="make_ajax_file"]', function(e) {
        that = this;
        e.preventDefault();
        baseJS.ajaxModel.makeAjaxWithFile(that);
        return false;
      });
      $(document).on("click", '[data-action="delete_record"]', function(e) {
        that = this;
        baseJS.ajaxModel.deleteRecord(that);
      });
    },
    loadModal: function(url) {
      $("#data_modal .modal-content").html('<p style="text-align: center;"><br/> <i class="fa fa-spinner fa-spin"></i>  Please wait loading...</p>');
      $.ajax({
        type: "GET",
        cache: false,
        url: url,
        success: function(result) {
          $(".all-modals .modal-content").html(result);
          try {
            baseJS.inputMasking.customMasking();
          } catch (e) {
            console.log("Unable to load Forminput | Timepickers");
          }
          try {
            baseJS.select2.initModal();
          } catch (e) {
            console.log("Unable to load select2");
          }
        },
      });
    },
    makeAjax: function(that) {
      var form = $(that).serialize();
      var btn = $(that).find("button[type=submit]");
      var btntxt = $(btn).html();
      let iValid = baseJS.formValidation.validate('form[data-action="make_ajax"]');
      if (iValid.flag == false) return false;
      addWait(btn, baseJS.lang.WORKING + "...");
      var selector = that;
      $.ajax({
        type: $(that).attr("method"),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        url: $(that).attr("action"),
        data: new FormData(that),
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(res) {
          removeWait(btn, btntxt);
          console.log(res.flag);
          if (res.flag == true) {
            baseJS.afterAajaxCall("success", res, selector);
          } else {
            baseJS.afterAajaxCall("error", res, selector);
          }
          return false;
        },
        error: function(err) {
          baseJS.afterAajaxCall("error", err.responseJSON.message);
          removeWait(btn, btntxt);
          return false;
        },
      });
    },
    makeAjaxWithFile: function(that) {
      event.preventDefault();
      var btn = $(that).find("button[type=submit]");
      var btntxt = $(btn).html();
      res = baseJS.formValidation.validate("form.make_ajax");
      if (res.flag == false) {
        res.dom.focus().scrollTop();
        return false;
      }
      addWait(btn, baseJS.lang.WORKING);
      $.ajax({
        type: $(that).attr("method"),
        contentType: false,
        cache: false,
        processData: false,
        dataType: "json",
        url: $(that).attr("action"),
        data: new FormData(that),
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(res) {
          removeWait(btn, btntxt);
          if (res.flag) toastr["success"](res.msg, "Completed!");
          else toastr["warning"](res.msg, "Oops!");
          if (res.action == "reload") {
            window.location.reload();
          } else if (res.action == "redirect") {
            window.location.href = res.url;
          } else {
            $("." + remvove).remove();
          }
        },
        error: function() {
          removeWait(btn, btntxt);
          toastr["error"]("Something went wrong", "Opps!");
        },
      });
    },
    deleteRecord: function(that) {
      var attr = $(that).attr("data-action");
      $.ajax({
        type: "GET",
        cache: false,
        url: $(that).attr("data-url"),
        dataType: "json",
        headers: {
          "X-CSRF-TOKEN": baseJS.csrf_token
        },
        success: function(res) {
          if (res.flag == true) {
            if (res.action == "reload") {
              window.location.reload();
            } else {
              baseJS.afterAajaxCall("success", res);
              $(that).closest("tr").remove();
            }
          }
        },
      });
    },
  },
  editable: {
    init: function() {
      $(document).ready(function() {
        var selector = '[data-action="editable"]';
        var preValue = "";
        $(selector + " [data-id]").each(function(index, value) {
          if ($(this).attr("data-input") == "text" || $(this).attr("data-input") == "textarea") {
            $(this).append(' <a href="#" class="edit-button" >' + baseJS.lang.EDIT + "</a>");
          }
        });
        $(document).on("click", selector + " .edit-button", function(e) {
          let text = $(this).parent().clone().children().remove().end().text();
          let input = $(this).parent().attr("data-input");
          let field = $(this).parent().attr("data-field");
          let dataId = $(this).parent().attr("data-id");
          console.log(text);
          preValue = text;
          if (input == "text") {
            $(this).parent().html('<input type="text" name="' +
              field +
              '" value="' +
              text +
              '" data-id="' +
              dataId +
              '" class="form-control" /> <a class="update-button" href="javascript:void(0)"> ' +
              baseJS.lang.UPDATE +
              ' </a>| <a href="javascript:void(0)" class="cancel-button"> ' +
              baseJS.lang.CANCEL +
              " </a>");
          }
          if (input == "textarea") {
            $(this).parent().html('<textarea class="form-control" name="' +
              field +
              '" data-id="' +
              dataId +
              '" >' +
              text +
              '</textarea> <a class="update-button" href="javascript:void(0)"> ' +
              baseJS.lang.UPDATE +
              ' </a>| <a href="javascript:void(0)" class="cancel-button"> ' +
              baseJS.lang.CANCEL +
              " </a>");
          }
        });
        $(document).on("click", selector + " .cancel-button", function(e) {
          $(this).parent().html(preValue +
            ' <a href="#" class="edit-button" >' +
            baseJS.lang.EDIT +
            "<a/>");
        });
        $(document).on("click", selector + " .update-button", function(e) {
          let text = $(this).closest(selector).find("[data-id]").find("input, textarea").val();
          let field = $(this).closest(selector).find("[data-id]").find("input, textarea").attr("name");
          let dataId = $(this).closest(selector).find("[data-id]").find("input, textarea").attr("data-id");
          let action = $(this).closest(selector).attr("data-url") + "/" + dataId;
          var that = $(this);
          data = new FormData();
          data.append(field, text);
          jQuery.ajax({
            type: "POST",
            url: action,
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            headers: {
              "X-CSRF-TOKEN": baseJS.csrf_token
            },
            success: function(res) {
              that.parent().html(text +
                ' <a href="#" class="edit-button" >' +
                baseJS.lang.EDIT +
                "<a/>");
            },
            error: function(error) {
              console.log(error);
            },
          });
        });
        $(document).on("change", selector + " [data-id] select, " + selector + " [data-id] checkbox", function(event) {
          data = new FormData();
          data.append($(this).attr("name"), $(this).val());
          let dataId = $(this).closest("td").attr("data-id");
          let action = $(this).closest(selector).attr("data-url") + "/" + dataId;
          $.ajax({
            type: "POST",
            url: action,
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(res) {
              if (res.flag == true) {}
            },
        });
        });
      });
},
},
bulkAction: {
  init: function() {
    $(document).on("change", 'form[data-action="bulk-action"] input[type="checkbox"]', function(e) {
      if ($(this).closest("th").length == 1) {
        if ($(this).prop("checked") == true) {
          $(this).closest("table").find("tbody").find("input[type='checkbox']").prop("checked", true);
        } else {
          $(this).closest("table").find("tbody").find("input[type='checkbox']").prop("checked", false);
        }
      }
    });
    $(document).on("click", 'form[data-action="bulk-action"] #actions button', function(event) {
      let select = $(this).closest("#actions").find("select").val();
      if (select == "") return;
      let action = $(this).closest("form").attr("action");
      if (action == "") return;
      let method = $(this).closest("form").attr("method");
      if (method == "") return;
      let checkedCount = $(this).closest("form").find("input[type='checkbox']:checked").length;
      if (checkedCount == 0) {
        return;
      }
      var form = $(this).closest("form").serialize();
      var formSeletor = $(this).closest("form");
      var btn = this;
      var btntxt = $(btn).html();
      addWait(btn, baseJS.lang.WORKING + "...");
      $.ajax({
        type: "POST",
        cache: false,
        data: form,
        url: action + "?action=" + select,
        dataType: "json",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function(res) {
          removeWait(btn, btntxt);
          baseJS.afterAajaxCall("success", res, formSeletor);
        },
        error: function(err) {
          removeWait(btn, btntxt);
          baseJS.afterAajaxCall("error", res, formSeletor);
        },
      });
    });
  },
},
};

function getRandomString() {
  var charset = "abcdefghijknopqrstuvwxyzACDEFGHJKLMNPQRSTUVWXYZ12345679";
  output = [];
  for (var i = 0; i < 4; i++) {
    var arr = charset.charAt(Math.floor(Math.random() * charset.length + 1));
    output.push(arr);
  }
  return output.join("") + new Date().getTime();
}

function extractExtension(fileName) {
  return fileName.substr(fileName.lastIndexOf(".") + 1);
}

function addWait(dom, lable) {
  $(dom).attr("disabled", "disabled");
  string = '<i class="fa fa-spinner fa-spin"></i> ' + lable;
  $(dom).html(string);
}

function removeWait(dom, lable) {
  $(dom).removeAttr("disabled");
  $(dom).html(lable);
}

function addWaitWithoutText(dom) {
  $(dom).attr("disabled", "disabled");
  string = '<i class="m-loader"></i>';
  $(dom).html(string);
}

function removeWaitWithoutText(dom, lable) {
  $(dom).removeAttr("disabled");
  $(dom).html(lable);
}

function ImportaddWaitWithoutText(dom) {
  $(dom).attr("disabled", "disabled");
  string = '<i class="m-loader">Importing</i>';
  $(dom).html(string);
}
$(document).ready(function() {
  $(document).on("keyup", ".keysyn", function(event) {
    target = $(this).attr("data-change");
    $(target).val($(this).val());
  });
  $(document).on("click", ".image-viewer", function(event) {
    var viewer = ImageViewer();
    viewer.show($(this).attr("src"));
  });
  $(document).on("click", ".simple-request", function(event) {
    var that = $(this);
    var preHtml = that.html();
    var postHtml = that.attr("data-post-html");
    var state = that.attr("data-state");
    that.html("working...");
    $.ajax({
      type: "GET",
      cache: false,
      url: that.attr("data-url"),
      dataType: "json",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      success: function(res) {
        var attr = $(this).attr("name");
        if (typeof postHtml !== "undefined") {
          that.html(postHtml);
        } else {
          that.html(preHtml);
        }
        if (state == "true") that.attr("data-state", "false");
        else that.attr("data-state", "true");
      },
    });
  });
  $(document).on("submit", "form.validate", function(event) {
    event.preventDefault();
    res = validateForm("form.validate");
    if (res.flag == false) {
      res.dom.focus().scrollTop();
    }
    return res.flag;
  });
  $(".scrolto").click(function() {
    target = $(this).attr("data-target");
    $("html, body").animate({
      scrollTop: $(target).offset().top - 186,
    }, 500);
  });
  $(".date_range_picker").each(function() {
    var dateRangeThis = this;
    var future = $(dateRangeThis).attr("data-future") == "false" ? false : true;
    var start_date = $(dateRangeThis).find("#start_date").val();
    var end_date = $(dateRangeThis).find("#end_date").val();
    $(this).daterangepicker({
      opens: App.isRTL() ? "left" : "right",
      maxDate: future ? false : moment(),
      startDate: start_date,
      endDate: end_date,
      dateLimit: {
        days: 60,
      },
      showDropdowns: true,
      showWeekNumbers: true,
      timePicker: false,
      timePickerIncrement: 1,
      timePicker12Hour: true,
      ranges: future ? {
        Today: [moment(), moment()],
        Yesterday: [moment().subtract("days", 1), moment().subtract("days", 1), ],
        "Last 7 Days": [moment().subtract("days", 6), moment()],
        "Last 30 Days": [moment().subtract("days", 29), moment()],
        "This Month": [moment().startOf("month"), moment().endOf("month"), ],
        "Last Month": [moment().subtract("month", 1).startOf("month"), moment().subtract("month", 1).endOf("month"), ],
      } : {
        Today: [moment(), moment()],
        Yesterday: [moment().subtract("days", 1), moment().subtract("days", 1), ],
        "Last 7 Days": [moment().subtract("days", 6), moment()],
        "Last 30 Days": [moment().subtract("days", 29), moment()],
        "This Month": [moment().startOf("month"), moment()],
        "Last Month": [moment().subtract("month", 1).startOf("month"), moment().subtract("month", 1).endOf("month"), ],
      },
      buttonClasses: ["btn"],
      applyClass: "green",
      cancelClass: "default",
      format: "MM/DD/YYYY",
      separator: " to ",
      locale: {
        applyLabel: "Apply",
        fromLabel: "From",
        toLabel: "To",
        customRangeLabel: "Custom Range",
        daysOfWeek: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
        monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", ],
        firstDay: 1,
      },
    }, function(start, end) {
      $(dateRangeThis).find("span").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
      $(dateRangeThis).find("#start_date").val(start.format("MM/DD/YYYY"));
      $(dateRangeThis).find("#end_date").val(end.format("MM/DD/YYYY"));
    });
    $(dateRangeThis).find("span").html(moment(start_date).format("MMMM D, YYYY") +
      " - " +
      moment(end_date).format("MMMM D, YYYY"));
  });
});

function removeURLParameter(url, parameter) {
  var urlparts = url.split("?");
  if (urlparts.length >= 2) {
    var prefix = encodeURIComponent(parameter) + "=";
    var pars = urlparts[1].split(/[&;]/g);
    for (var i = pars.length; i-- > 0;) {
      if (pars[i].lastIndexOf(prefix, 0) !== -1) {
        pars.splice(i, 1);
      }
    }
    url = urlparts[0] + "?" + pars.join("&");
    return url;
  } else {
    return url;
  }
}
var form = {
  val: "",
  type: "",
  validate: function(type, val) {
    this.val = val;
    this.type = type;
    switch (this.type) {
    case "email":
      return this.isEmail();
      break;
    case "integer":
      return this.isInteger();
      break;
    case "url":
      return this.isUrl();
      break;
    }
  },
  isEmail: function() {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(this.val);
  },
  isInteger: function() {
    return /^\d+$/.test(this.val);
  },
  isUrl: function() {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    return regexp.test(this.val);
  },
};

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(".view_upload_image").attr("src", e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
var getDaysFromDates = function(firstDate, secondDate) {
  oneDay = 24 * 60 * 60 * 1000;
  firstDate = new Date(firstDate);
  secondDate = new Date(secondDate);
  return Math.round(Math.abs((firstDate.getTime() - secondDate.getTime()) / oneDay));
};
var addDays = function(date, days) {
  var result = new Date(date);
  result.setDate(result.getDate() + days);
  return result;
};
var formatDate = function(date, spilter) {
  var d = new Date(date),
  month = "" + (d.getMonth() + 1),
  day = "" + d.getDate(),
  year = d.getFullYear();
  if (month.length < 2) month = "0" + month;
  if (day.length < 2) day = "0" + day;
  return [month, day, year].join(spilter);
};
$(".upload-image").change(function() {
  readURL(this);
});
var container = "#commentBox";
$(document).ready(function() {
  $(document).on("paste", container + " textarea", function(e) {
    var action = $(this).closest("#commentBox").attr("image-add-action");
    var deleteUrl = $(this).closest("#commentBox").attr("image-delete-action");
    var data = e.originalEvent;
    if (data.clipboardData && data.clipboardData.items) {
      var items = data.clipboardData.items;
      for (var i = 0; i < items.length; i++) {
        if (items[i].type.indexOf("image") !== -1) {
          var file = items[i].getAsFile();
          let uniqueID = getRandomString();
          var fileName = uniqueID + "." + extractExtension(file.name);
          $(container + " .images-list").append('<div id="' +
            uniqueID +
            '" data-file="' +
            fileName +
            '">' +
            fileName +
            ' <span class="upload"> - uploading</span><a href="javascript:void()" data-url="' +
            deleteUrl +
            "?filename=" +
            fileName +
            '" class="delete"></a></div>');
          data = new FormData();
          data.append("file", file);
          jQuery.ajax({
            type: "POST",
            url: action + "?filename=" + fileName,
            data: data,
            contentType: false,
            processData: false,
            cache: false,
            dataType: "json",
            headers: {
              "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(res) {
              console.log(res);
              $(container + " .images-list #" + uniqueID + " .delete").html("x");
              $(container + " .images-list #" + uniqueID + " .upload").html("");
              let files = $("#images").val();
              if (files == "") {
                $("#images").val(res.file);
              } else {
                $("#images").val(files + "," + res.file);
              }
            },
            error: function(error) {
              console.log(error);
            },
          });
        }
      }
    }
  });
  $(document).on("click", container + " .images-list .delete", function(e) {
    let files = $(container + " #images").val();
    let file = $(this).closest("div").attr("data-file");
    files = files.split(",");
    const index = files.indexOf(file);
    if (index > -1) {
      files.splice(index, 1);
    }
    $("#images").val(files.join(","));
    var that = $(this);
    $.ajax({
      type: "GET",
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      url: $(this).closest(container).attr("image-delete-action") +
      "?filename=" +
      file,
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      success: function(res) {
        that.closest("div").remove();
      },
      error: function(err) {
        console.log(err.responseJSON);
      },
    });
  });
  $(document).on("click", container + " .save", function(e) {
    $.ajax({
      type: "POST",
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      url: $(this).closest("form").attr("action"),
      data: new FormData($(this).closest("form")[0]),
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      success: function(res) {
        html = "<div>";
        html += '<ul class="action"><li class="date"> Commmented at: ' +
        res.data.date +
        " | By: " +
        res.data.user.name +
        '</li><li class="delete"><a href="javascript:void(0)" data-id="' +
        res.data.com_id +
        '"> remove</a></li></ul>';
        html += '<div class="comments">';
        let files = $("#images").val();
        files = files.split(",");
        for (i = 0; i < files.length; i++) {
          if (files[i] != "")
            html += '<a href="' +
          files[i] +
          '" target="_blank"><img width="100" src="' +
          files[i] +
          '"></a>';
        }
        html += "<p>" + res.data.comments + "</p>";
        html += "</div>";
        html += "</div>";
        $(container + " .images-list").html("");
        $(container + " textarea").val("");
        $(container + " #images").val("");
        $(container + " .comment-list").append(html);
      },
      error: function(err) {
        console.log(err.responseJSON);
      },
    });
  });
  $(document).on("click", container + " .comment-list .delete", function(e) {
    var that = $(this);
    var action = $(this).closest(container).attr("data-comment-delete-url") +
    "/" +
    that.attr("data-id");
    that.closest("div").remove();
    $.ajax({
      type: "GET",
      contentType: false,
      cache: false,
      processData: false,
      dataType: "json",
      url: action,
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      success: function(res) {},
      error: function(err) {
        console.log(err.responseJSON);
      },
    });
  });
  $(document).on("click", container + " .cancel", function(e) {
    $(container + " .images-list").html("");
    $(container + " textarea").val("");
    $(container + " #images").val("");
  });
});