/*
 *Copyright (c) 2019 Revers.io
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author revers.io
 * @copyright Copyright (c) permanent, Revers.io
 * @license   Revers.io
 * @see       /LICENSE
 */

$(document).ready(function () {
    $('body').on('click', '.js-revers-io-order-import-button', foImportOrderToReversIo);

    function foImportOrderToReversIo() {
        $.ajax(initialOrderImportAjaxUrl, {
            method: 'POST',
            data: {
                action: 'foImportOrderToReversIo',
                ajax: 1,
                orderId: $('.revers-io-order-id').val(),
                token: prestashop.static_token,
            },
            success: function (response) {
                response = JSON.parse(response);
                if (response.success === true) {
                    window.location = response.url;
                } else {
                    window.location.reload();
                }
            },
            error: function (response) {
                alert('Error with ajax callback, please try again initial import');
            }
        });
    }
});
