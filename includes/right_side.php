<div class="header">
            <div class="imgText">
                    <div class="userimg">
                        <img src="../images/user_male.jpg" id="profile_image2" alt=""  class="cover">
                    </div>
                    <div class="online">
                    <h4 class="name">Qazi</h4>
                    <span style="margin-left:10px;">offline</span>
                    </div>
                </div>
                
            </div>

            <!-- CHAT-BOX -->
            <div class="chatbox">
                
               
            </div>
            
            <!-- CHAT INPUT -->
            <div class="chat_input">
            <label for="file-input" ><i class="fa fa-paperclip" style=" padding-left:10px;"></i></label>
            <input type="file" id="file-input" style="display:none" onchange="send_image(this.files)">
                <input type="text" id="input" placeholder="Type a message">
                <i class="fa fa-paper-plane" onClick="send_messege(event)" style="cusor:pointer;" aria-hidden="true"></i>
            </div>