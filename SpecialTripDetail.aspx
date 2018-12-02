<%@ Page Title="" Language="C#" MasterPageFile="~/Main.Master" clientidmode="static" AutoEventWireup="true" CodeBehind="SpecialTripDetail.aspx.cs" Inherits="JoinMyTrip.Web.SpecialTripDetail" %>

<%@ Import Namespace="JoinMyTrip.Web.ClassLibrary" %>
 <asp:Content ID="Content1" ContentPlaceHolderID="HeadContent" Runat="Server" >
	<link href="Assets/style/specialtripdetail.css?v=20180622" rel="stylesheet" />
    <title>JoinMyTrip约旅趣 - 提供约伴结伴服务分摊包车、拼车、旅程活动费用</title>
    <link href="Assets/style/library/Bootstrap/css/bootstrap-switch.min.css" rel="stylesheet" />
    <script src="https://cdn.staticfile.org/jQuery-linkify/2.0.5/linkify.min.js"></script>
    <script src="https://cdn.staticfile.org/jQuery-linkify/2.0.5/linkify-jquery.min.js"></script>
    <script src="Assets/script/library/JQuery/jquery.signalR-2.2.2.js"></script>
    <script src='<%: ResolveClientUrl("~/signalr/js") %>'></script>
    <script src="Assets/script/library/Bootstrap/bootstrap-switch.min.js"></script>
    <script src="assets/script/specialtripdetail.js?v=20180705"></script>
</asp:Content>
<asp:Content ID="Content2" ContentPlaceHolderID="PageContent" Runat="Server" >
    <%if (loggedInUser != null){ %>
        <input type="hidden" id ="attened" value ="<%= attened %>"/>
        <input type="hidden" id ="userId" value ="<%= loggedInUser.id %>"/>
        <input type="hidden" id ="userName" value ="<%=loggedInUser.name %>"/>
        <input type="hidden" id ="photoPath" value="<%= PhotoRender.DetermineUserPhotoPath(photos, loggedInUser.gender) %>"/>
        <input type="hidden" id ="time" value="<%=plan.time.Value.ToString("hh:mm")%>"/>
        <input type="hidden" id ="myPlanId" value ="<%= myPlanId %>"/>
        <input type="hidden" id ="receiveMessageRemind" value="<%= receiveMessageRemind %>"/>
    <%} %>
        <input id ="planId" value ="<%= planId %>" type ="hidden"/>
        <input id ="journeyId" value ="<%= plan.journeyId %>" type ="hidden"/>
    <div id="process-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content" style="background-color: #f7f7f7;">
                <div class="modal-body">
                    <div class="modal-booking-process" style="height:350px;">
                        <div class="process-title">預定流程</div>
                        <div class="process col-xs-12">
                            <div class="process-frame" style="border:2px solid #f88e8e;">
                                <div class="modal-process-frame-title flex-vertical-center col-xs-2">步驟一</div>
                                <div class="modal-process-frame-content flex-vertical-center col-xs-10">
                                    点击「加入结伴」按钮，填写微信号
                                </div>
                            </div>
                        </div>
                        <div class="process col-xs-12">
                            <div class="process-frame">
                                <div class="modal-process-frame-title flex-vertical-center col-xs-2">步驟二</div>
                                <div class="modal-process-frame-content flex-vertical-center col-xs-10">
                                    点击「前往填写」按钮，填写入园人姓名与证件号码【若没填写完成，务必回来补填写】
                                </div>
                            </div>
                        </div>
                        <div class="process col-xs-12">
                            <div class="process-frame">
                                <div class="modal-process-frame-title flex-vertical-center col-xs-2">步驟三</div>
                                <div class="modal-process-frame-content flex-vertical-center col-xs-10">
                                    等待微信公众号通知组团成功(出行前6天)
                                </div>
                            </div>
                        </div>
                        <div class="text-center process col-xs-12">
                            <div class="row">
                                <div class="col-xs-3">
                                    <p id="count-text"></p>
                                </div>
                                <div class="col-xs-6" style="padding:0px;">
                                    <div id="modal-got-it" class="btn" disabled="disabled">确认～我仔细看完了！</div>
                                </div>                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
    <div class="col-lg-10 col-lg-offset-1" style="padding-top:20px;">
        <div class="row">
            <div id="title" class="special-trip-detail-title col-xs-12 col-sm-5"><%= plan.title %></div>
            <div class="serach-other col-xs-12 col-sm-7"><a href="/LongKeng.aspx#search" target="_blank">探索其他團</a></div>
        </div>
        <hr class="clear"/>
        <div class="plan-detail_attend-plan">
            <div class="col-sm-6 col-xs-12">
                <div class="row flex-horizontal-center">
                    <div class="text-center col-sm-6 col-xs-8 flex-vertical-center">
                        <div class="col-sm-12">
                            <img  class="calendar" src="assets/images/calendar.png" style="width:20%; padding-bottom:10px;"/><br>
                             <%=plan.date.Date.ToShortDateString() %>
                            (<%=plan.date.ToString("ddd",new System.Globalization.CultureInfo("zh-cn")).Trim("周".ToCharArray())%>) <br>
                            第<%=plan.group_index %>場<%=plan.time == null? "": plan.time.Value.ToString("hh:mm")%><br>
                        </div>
                    </div>
                    <div class="card-group text-center col-sm-6 col-xs-4 flex-vertical-center">
                        <div class="col-sm-12">
                            <div class="card-group-circle flex-vertical-center ">
                                <p>Group</p>
                                <p class="card-group-name"><%=plan.group_index %></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="clear horizontal-dashed-hr" />
                <div class="attend-plan">
                    <%if (loggedInUser != null){%>
                        <div class="flex-vertical-center" style="height:inherit;">
                            <!--未加入結伴，未鎖團-->
                            <%if (attened == false && plan.locked == false){ %>
                                <div id="attend-plan-btn" class="row">
                                    <div class="btn attend-plan-btn col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">加入結伴</div> 
                                </div>                      
                            <%} %>     
                            <!--已加入結伴，未鎖團-->
                            <%if (attened == true && plan.locked == false){ %>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6 text-left">
                                        已加入
                                        <i class="fa fa-check-circle fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-sm-6 col-xs-6 text-right">
                                        <a href="###" id="cancel-plan" style="text-decoration:underline;color:#cc3333;font-weight:bold;">取消結伴</a>
                                    </div>
                                </div>
                            <%} %>
                            <!--已加入結伴，已鎖團-->
                            <%if (attened == true && plan.locked == true){ %>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6 text-left">
                                        已加入
                                        <i class="fa fa-check-circle fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-sm-6 col-xs-6 text-right" style="color:#cc3333;font-weight:bold;">
                                        已鎖團
                                    </div>
                                </div>
                            <%} %>
                            <!--未加入結伴，已鎖團-->
                            <%if (attened == false && plan.locked == true){ %>
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6">
                                    </div>
                                    <div class="col-sm-6 col-xs-6" style="color:#cc3333;font-weight:bold;">
                                        已鎖團
                                    </div>
                                </div>
                            <%} %>
                            <div class="row hidden">
                                <div id="change-to-this-btn" class="btn col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">改成這個組</div> 
                            </div>
                        </div> 
                    <%} %>
                    <%else{%>
                        <div class="row">
                            <a href="/LogIn.aspx">
                                <div class="btn attend-plan-btn col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">請登入以加入結伴</div>
                            </a>
                        </div>
                    <%} %>
                </div>
            </div>
            <div class="row mobile-clear">
                <div class="col-xs-12">
                    <hr class="clear" />
                </div>
            </div>
            <div class="process_member col-sm-6 col-xs-12">
                <div class="partner">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="process-title col-xs-7">同行夥伴(<%=totalMemberNumber%>)</div>
                                <div class="col-xs-5 text-right">
                                    <a href="#" id="process-modal-show-text">預定流程</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="row">
                            <%for (int i = 0; i < members.Count; i++){ %>
                                <div class="text-center col-sm-2 col-xs-4" style="padding-left: 0px;">
                                    <%if (loggedInUser != null && loggedInUser.id == adminUserId && members[i].userId != adminUserId) { %>
                                        <div class="deleteMemberButton" onclick="removeMemberAlert('<%= members[i].userId %>')">
                                            <img class='deleteMemberButtonImg' src='/Assets/images/icon/member_delete.png' />
                                        </div>
                                    <%} %>
                                    <a type="lnkUserProfile" href="userprofile.aspx?userid=<%= members[i].userId%>">
                                        <img class="member-img" src="<%= PhotoRender.DetermineUserPhotoPath(members[i].photos, members[i].gender) %>" />
                                    </a>
                                    <br />
                                   <span class="member-info members-name"><%=members[i].name %></span>
                                    <br />
                                    <span class="member-info members-persons"><%=members[i].persons %>人</span>
                                </div>    
                            <%} %>
                            <div class="text-center col-sm-2 col-xs-4 dashed-circle"></div>      
                        </div>          
                    </div>
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-xs-12">
                <hr class="clear"/>
            </div>
        </div>       
        <div class="chat-block row">
            <div class="helper col-sm-6 col-xs-12">
                <div class="row flex-horizontal-center">
                    <div class="col-sm-5 col-xs-5" style="padding-right: 0px">
                        <img style="width: 95%;" src="assets/images/CAP_IMG.png" />
                    </div>
                    <div class="helper-font col-sm-7 col-xs-7">
                        <h1><b>小约</b></h1>
                        <div class="helper-introduction">
                            <p>
                                专攻：揪团、生活疑难杂症<br />
                                成功率：100%
                            </p>
                        </div>
                        <div class="helper-call">
                            <%if (loggedInUser != null){ %>
                                <input type="button" id="btnHelper" class="btn helper-btn helper-btn-login" value="小约，你在吗"/>
                            <%} %>
                            <%else { %>
                                <div disabled="disabled" class="btn helper-btn hidden-xs">登入后让小帮手帮你解决问题</div>
                                <div disabled="disabled" class="btn helper-btn visible-xs">登入后让小帮手<br />帮你解决问题</div>
                            <%} %>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-room col-sm-6 col-xs-12 flex-vertical-center">
                <div class="chat-background">
                    <div style="font-size:24px;font-weight:bold;">聊天對話</div>
                    <hr class="clear" style="margin-top:5px; margin-bottom:10px;"/>
                    <div class="member-chat-wrapper">
                    <%if (replies.Count > 3){ %>
                        <div style="margin-bottom:20px">
                            <a href="#" class="see_info" id="see_more_message">顯示先前留言<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                            <a href="#" class="see_info" id="see_less_message" style="display:none;">隱藏先前留言 <i class="fa fa-caret-up" aria-hidden="true"></i></a>
                        </div>  
                        <%for (int i = 0; i < replies.Count - 3; i++){ %>
                            <div class="row member-chat member-chat-hide" style="display:none;">
                                <div class="text-center col-sm-2 col-xs-2">
                                    <a class="js-replier-name" href="userprofile.aspx?userid=<%= replies[i].replier.userId%>">
                                        <img class="chat-member-img" src="<%= PhotoRender.DetermineUserPhotoPath(replies[i].replier.photos, replies[i].replier.gender) %>" />
                                    </a>
                                </div> 
                                <div class="col-sm-3 col-xs-3">
                                    <a class="js-replier-name" href="userprofile.aspx?userid=<%= replies[i].replier.userId%>">
                                        <%= replies[i].replier.name %>
                                    </a>
                                </div>  
                                <div class="col-sm-7 col-xs-7 message" style="word-break: break-all;">
                                    <%= replies[i].message %>
                                </div> 
                            </div>
                            <hr class="clear member-chat-hide" style="margin-top:10px; margin-bottom:10px;display:none;" />
                        <%} %>
                        <%for (int i = replies.Count - 3; i < replies.Count; i++){ %>
                            <div class="row member-chat">
                                <div class="text-center col-sm-2 col-xs-2">
                                    <a class="js-replier-name" href="userprofile.aspx?userid=<%= replies[i].replier.userId%>">
                                        <img class="chat-member-img" src="<%= PhotoRender.DetermineUserPhotoPath(replies[i].replier.photos, replies[i].replier.gender) %>" />
                                    </a>
                                </div> 
                                <div class="col-sm-3 col-xs-3">
                                    <a class="js-replier-name" href="userprofile.aspx?userid=<%= replies[i].replier.userId%>">
                                        <%= replies[i].replier.name %>
                                    </a>
                                </div>  
                                <div class="col-sm-7 col-xs-7 message" style="word-break: break-all;">
                                    <%= replies[i].message %>
                                </div>
                            </div>
                            <% if(i < (replies.Count-1)) {%>
                                <hr class="clear" style="margin-top:10px; margin-bottom:10px;" />
                            <%} %>
                        <%} %>
                    <%} %>
                    <%else{ %>
                        <%for (int i = 0; i < replies.Count; i++){ %>
                            <div class="row member-chat" >
                                <div class="text-center col-sm-2 col-xs-2">
                                    <a class="js-replier-name" href="userprofile.aspx?userid=<%= replies[i].replier.userId%>">
                                        <img class="chat-member-img" src="<%= PhotoRender.DetermineUserPhotoPath(replies[i].replier.photos, replies[i].replier.gender) %>" />
                                    </a>
                                </div> 
                                <div class="col-sm-3 col-xs-3">
                                    <a class="js-replier-name" href="userprofile.aspx?userid=<%= replies[i].replier.userId%>">
                                        <%= replies[i].replier.name %>
                                    </a>
                                </div>  
                                <div class="col-sm-7 col-xs-7 message" style="word-break: break-all;">
                                    <%= replies[i].message %>
                                </div>
                            </div>
                            <% if(i < (replies.Count-1)) {%>
                               <hr class="clear" style="margin-top:10px; margin-bottom:10px;" />
                            <%} %>
                        <%} %>
                        <%for (int i = 0; i < 3 - replies.Count; i++){ %>
                            <div class="row member-chat" style="height:70px"></div>
                        <%} %>
                    <%} %>
                    </div>
                    <hr class="clear" style="margin-top:5px; margin-bottom:30px;"/>
                    <!--手機板的tag候選區 Start-->
                    <div class="row tags-selection" id="tags-mobile" style="display:none;">
                        <div class="col-xs-9">
                            <div class="list-group" style="margin-bottom:0px;">
                                <%for (int i = 0; i < members.Count; i++){ %>
                                    <a class="list-group-item"><%= members[i].name %><input type="hidden" value="<%= members[i].userId %>" /></a>
                                <%} %>
                            </div>
                        </div>                        
                    </div>
                    <!--手機板的tag候選區 End-->
                    <div class="row flex-horizontal-center" style="height:10%;">
                        <%if (loggedInUser != null){ %>
                            <div class="col-sm-10 col-xs-9" style="height:100%;">
                                <div contenteditable="true" placeholder="輸入留言" id="txtMessage"></div>
                            </div>
                            <div class="col-sm-2 col-xs-3 text-center" style="height:100%;">
                                <input type="submit" id="btnMessage" class="message-btn" value="送出"/>
                            </div>
                        <%} %>
                        <%else{ %>
                            <div class="col-sm-10 col-xs-9" style="height:100%;">
                                <textarea rows="1" placeholder="请登入"class="form-control"></textarea>
                            </div>
                            <div class="col-sm-2 col-xs-3 text-center" style="height:100%;">
                                <input type="submit" class="message-btn" disabled="disabled" value="送出"/>
                            </div>
                        <%} %>
                    </div>
                    <!--電腦板的tag候選區 Start-->
                    <div class="row tags-selection" id="tags-computer" style="display:none;">
                        <div class="col-sm-10">
                            <div class="list-group">
                                <%for (int i = 0; i < members.Count; i++){ %>
                                    <a class="list-group-item"><%= members[i].name %><input type="hidden" value="<%= members[i].userId %>" /></a>
                                <%} %>
                            </div>
                        </div>                        
                    </div>
                    <!--電腦板的tag候選區 End-->
                    <%if (loggedInUser != null ){ %>
                        <div class="message-switch flex-horizontal-center" style="margin-top:15px;float:right;">
                            <span style="padding-right:10px;">接收所有團員留言通知</span>
                            <input type="checkbox" class="message-switch"/>
                        </div>
                    <%} %>
                    <%else{ %>
                        <div class="message-switch flex-horizontal-center" style="margin-top:15px;float:right;">
                            <span style="padding-right:10px;">接收所有團員留言通知</span>
                            <input type="checkbox" class="message-switch" disabled="disabled"/>
                        </div>
                    <%} %>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="FillDetailModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="margin-top:calc(50vh/2);" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fa fa-exclamation-circle fa-4x" aria-hidden="true"></i>
                    <h4>尚未組團完成喔....</h4>
                    <h4>請點選以下按鈕，前往填寫團員詳細資料。</h4>
                    <div id="fill-detail-btn" class="btn">前往填寫</div>
                </div>
            </div>
        </div>
    </div>
</asp:Content>