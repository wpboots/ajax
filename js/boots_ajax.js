/**
 * Ajax - javascript
 *
 * @package Boots
 * @subpackage Ajax
 * @version 1.0.0
 * @license GPLv2
 *
 * Boots - The missing WordPress framework. http://wpboots.com
 *
 * Copyright (C) <2014>  <M. Kamal Khan>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 */

(function($){
    "use strict";

    $.BootsAjax = function(args){

        var self = this;

        self.url = boots_ajax.url;

        self.options = $.extend({
            data : {},
            action : '',
            nonce : '',
            type : 'POST',
            dataType : 'json',
            done : function(Data, status, jqXHR){},
            fail : function(jqXHR, status, error){},
            always : function(Data_jqXHR, status, jqXHR_error){}
        }, args);

        self.options.data = typeof self.options.data === 'object'
        ? $.extend(self.options.data, {
            _action : self.options.action,
            _nonce  : self.options.nonce
        })
        : '_action='+self.options.action+'&_nonce='+self.options.nonce+'&'+self.options.data;

        delete self.options.action;
        delete self.options.nonce;

        var done = self.options.done;
        var fail = self.options.fail;
        var always = self.options.always;

        delete self.options.done;
        delete self.options.fail;
        delete self.options.always;

        var Request = $.ajax(self.url, self.options)
        .done(function(Data, status, jqXHR){
            done(Data, status, jqXHR);
        }).fail(function(jqXHR, status, error){
            fail(jqXHR, status, error);
        }).always(function(Data_jqXHR, status, jqXHR_error){
            always(Data_jqXHR, status, jqXHR_error);
        });

        return Request;
    }

})(jQuery);
