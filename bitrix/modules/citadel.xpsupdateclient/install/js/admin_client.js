
$(function() {
    $("#client_edit_form").find("input[name=action]").val("");

    $("#tab_cont_server")
        .prop("onclick", null)
        .click(function() {
            if (!$(this).hasClass("adm-detail-tab-active")) {
                BX.showWait();
                $("#client_edit_buttons_div").find("input").prop("disabled", "disabled");
                $("#client_edit_form").find("input[name=action]").val("showtab");
                $('#client_edit_active_tab').val("server");
                $("#client_edit_form").trigger("submit");
            }
            return false;
        });

    $("#tab_cont_iblocks")
        .prop("onclick", null)
        .click(function() {
            if (!$(this).hasClass("adm-detail-tab-active")) {
                BX.showWait();
                $("#client_edit_buttons_div").find("input").prop("disabled", "disabled");
                $("#client_edit_form").find("input[name=action]").val("showtab");
                $('#client_edit_active_tab').val("iblocks");
                $("#client_edit_form").trigger("submit");
            }
            return false;
        });


    $("#btn_add_sync_property").click(function() {
        let $new = $("#client_sync_property_table_cont").find("table.client_sync_property_table:first").clone();
        $("#client_sync_property_table_cont").find("table.client_sync_property_table:last").after($new);
        $new.find("select").val("").trigger("change");
        return false;
    });

    $("#client_sync_property_table_cont").on("click", ".btn_delete_sync_property", function() {
        if ($("#client_sync_property_table_cont").find("table.client_sync_property_table").length > 1) {
            $(this).closest("table").remove();
        }
        return false;
    });


    $("#SERVER_IBLOCK_TYPE").on("change", function() {
        let val = $(this).val();

        $("#SERVER_IBLOCK_ID").find("option").each(function(i) {
            if (i > 0) {
                if ($(this).data("type") === val) {
                    $(this).removeClass("hidden");
                } else {
                    $(this).addClass("hidden");
                    $(this).prop("selected", null);
                }
            }
        });

        if ($("#SERVER_IBLOCK_ID").find("option:selected").length === 0) {
            $("#SERVER_IBLOCK_ID").val("");
            $("#SERVER_IBLOCK_ID").find("option:visible:eq(0)").prop("selected", "selected");
        }

        $("#SERVER_IBLOCK_ID").trigger("change")
    });

    $("#SERVER_IBLOCK_ID").on("change", function() {
        let val = $(this).val();

        $("#SERVER_IBLOCK_KEY_ID").add("table.client_sync_property_table td.client_sync_property_table_server select").each(function() {
            $(this).find("option").each(function(i) {
                if (i > 0) {
                    if ($(this).data("iblock") == val) {
                        $(this).removeClass("hidden");
                    } else {
                        $(this).addClass("hidden");
                        $(this).prop("selected", null);
                    }
                }
            });

            if ($(this).find("option:selected").length === 0) {
                $(this).val("");
                $(this).find("option:visible:eq(0)").prop("selected", "selected");
            }
        });
    });

    $("#SERVER_IBLOCK_KEY_ID").on("change", function(e, isJustRefresh) {
        let type = $(this).find("option:selected").data("type"),
            iblock = $("#CLIENT_IBLOCK_ID").val(),
            $client_select = $("#CLIENT_IBLOCK_KEY_ID");

        if (!type) {
            $client_select.val("");
        }

        $client_select.find("option").each(function(i) {
            if (i > 0) {
                if (($(this).data("type") == type || !type) && $(this).data("iblock") == iblock) {
                    $(this).removeClass("hidden");
                } else {
                    $(this).addClass("hidden");
                    $(this).prop("selected", null);
                }
            }
        });

        if ($client_select.find("option:selected").length === 0) {
            $client_select.val("");
            $client_select.find("option:visible:eq(0)").prop("selected", "selected");
        }

        if (!type && !isJustRefresh) {
            $client_select.trigger("change", [true]);
        }
    });

    $("#client_sync_property_table_cont").on("change", "td.client_sync_property_table_server select", function(e, isJustRefresh) {
        let type = $(this).find("option:selected").data("type"),
            iblock = $("#CLIENT_IBLOCK_ID").val(),
            $client_select = $(this).closest("tr").find("td.client_sync_property_table_client select");

        if (!type) {
            $client_select.val("");
        }

        $client_select.find("option").each(function(i) {
            if (i > 0) {
                if (($(this).data("type") == type || !type) && $(this).data("iblock") == iblock) {
                    $(this).removeClass("hidden");
                } else {
                    $(this).addClass("hidden");
                    $(this).prop("selected", null);
                }
            }
        });

        if ($client_select.find("option:selected").length === 0) {
            $client_select.val("");
            $client_select.find("option:visible:eq(0)").prop("selected", "selected");
        }

        if (!type && !isJustRefresh) {
            $client_select.trigger("change", [true]);
        }
    });


    $("#CLIENT_IBLOCK_TYPE").on("change", function() {
        let val = $(this).val();

        $("#CLIENT_IBLOCK_ID").find("option").each(function(i) {
            if (i > 0) {
                if ($(this).data("type") === val) {
                    $(this).removeClass("hidden");
                } else {
                    $(this).addClass("hidden");
                    $(this).prop("selected", null);
                }
            }
        });

        if ($("#CLIENT_IBLOCK_ID").find("option:selected").length === 0) {
            $("#CLIENT_IBLOCK_ID").val("");
            $("#CLIENT_IBLOCK_ID").find("option:visible:eq(0)").prop("selected", "selected");
        }

        $("#CLIENT_IBLOCK_ID").trigger("change")
    });

    $("#CLIENT_IBLOCK_ID").on("change", function() {
        let val = $(this).val();

        $("#CLIENT_IBLOCK_KEY_ID").add("table.client_sync_property_table td.client_sync_property_table_client select").each(function() {
            $(this).find("option").each(function(i) {
                if (i > 0) {
                    if ($(this).data("iblock") == val) {
                        $(this).removeClass("hidden");
                    } else {
                        $(this).addClass("hidden");
                        $(this).prop("selected", null);
                    }
                }
            });

            if ($(this).find("option:selected").length === 0) {
                $(this).val("");
                $(this).find("option:visible:eq(0)").prop("selected", "selected");
            }
        });
    });

    $("#CLIENT_IBLOCK_KEY_ID").on("change", function(e, isJustRefresh) {
        let type = $(this).find("option:selected").data("type"),
            iblock = $("#SERVER_IBLOCK_ID").val(),
            $client_select = $("#SERVER_IBLOCK_KEY_ID");

        if (!type) {
            $client_select.val("");
        }

        $client_select.find("option").each(function(i) {
            if (i > 0) {
                if (($(this).data("type") == type || !type) && $(this).data("iblock") == iblock) {
                    $(this).removeClass("hidden");
                } else {
                    $(this).addClass("hidden");
                    $(this).prop("selected", null);
                }
            }
        });

        if ($client_select.find("option:selected").length === 0) {
            $client_select.val("");
            $client_select.find("option:visible:eq(0)").prop("selected", "selected");
        }

        if (!type && !isJustRefresh) {
            $client_select.trigger("change", [true]);
        }
    });

    $("#client_sync_property_table_cont").on("change", "td.client_sync_property_table_client select", function(e, isJustRefresh) {
        let type = $(this).find("option:selected").data("type"),
            iblock = $("#SERVER_IBLOCK_ID").val(),
            $client_select = $(this).closest("tr").find("td.client_sync_property_table_server select");

        if (!type) {
            $client_select.val("");
        }

        $client_select.find("option").each(function(i) {
            if (i > 0) {
                if (($(this).data("type") == type || !type) && $(this).data("iblock") == iblock) {
                    $(this).removeClass("hidden");
                } else {
                    $(this).addClass("hidden");
                    $(this).prop("selected", null);
                }
            }
        });

        if ($client_select.find("option:selected").length === 0) {
            $client_select.val("");
            $client_select.find("option:visible:eq(0)").prop("selected", "selected");
        }

        if (!type && !isJustRefresh) {
            $client_select.trigger("change", [true]);
        }
    });


    $("#SERVER_IBLOCK_TYPE").trigger("change");
    $("#CLIENT_IBLOCK_TYPE").trigger("change");
    $("#SERVER_IBLOCK_KEY_ID").trigger("change");
    $("#CLIENT_IBLOCK_KEY_ID").trigger("change");
    $("#client_sync_property_table_cont td.client_sync_property_table_server select").trigger("change");
    $("#client_sync_property_table_cont td.client_sync_property_table_client select").trigger("change");
});
