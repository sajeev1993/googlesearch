 <div style="background: #e2e2e2; font-family: arial,sans-serif; font-size: 14px;">
    <table border="0" width="600" cellspacing="0" cellpadding="5" align="center">
        <tbody>
            <tr>
                <td height="60">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr bgcolor="#fff">
                <td height="60">&nbsp;</td>
                <td colspan="3">
                <div style="text-align: center; margin-bottom: 20px;     border-bottom: 1px solid #ddd; padding-bottom: 25px;">
                    <img src="{{asset('logo.png')}}" alt="logo" style="width:9%;">
                    </a></div>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td bgcolor="#FFFFFF" height="32">&nbsp;</td>
                <td colspan="3" bgcolor="#FFFFFF">
                    <div>
                        <h2 style="color: #000; font-weight: normal; font-size: 16px;">Hi,</h2>
                    </div>
                </td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
                <td bgcolor="#FFFFFF" height="26">&nbsp;</td>
                <td colspan="3" bgcolor="#FFFFFF">
                    <div style="color: #333; font-size: 15px;">
                    @if(count($errors) > 0)

                        @foreach($errors as $error) 

                        <td> {{$error}} </td>
                        @endforeach    
                    @else
                        No errors found on the file, upload complete
                    @endif
                    <br>
                </div>
                </td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            <tr>
                <td bgcolor="#FFFFFF" height="71">&nbsp;</td>
                <td colspan="3" bgcolor="#FFFFFF">
                    <div>
                        <div style="color: #333; font-size: 15px;">Regards,</div>
                        <div style="color: #333; font-size: 15px; "> Test</div>
                    </div>
                </td>
                <td bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
            
            <tr>
            <td bgcolor="#FFFFFF" height="26">&nbsp;</td>
            <td colspan="3" bgcolor="#FFFFFF">
            <div style="text-align: center; font-size: 10px; color: #990000; margin-bottom: 40px;">[ This is an automated message. Please do not reply to this <span class="il">mail</span> ]</div>
            </td>
            <td bgcolor="#FFFFFF">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    
</div>