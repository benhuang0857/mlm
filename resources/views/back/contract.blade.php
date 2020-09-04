<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            * {
                font-family: 'MINGLIU';
            }

            #invoice{
                padding: 30px;
            }

            .invoice {
                position: relative;
                background-color: #FFF;
                min-height: 680px;
                padding: 15px
            }

            .invoice header {
                padding: 10px 0;
                margin-bottom: 20px;
                border-bottom: 1px solid #3989c6
            }

            .invoice .company-details {
                text-align: right
            }

            .invoice .company-details .name {
                margin-top: 0;
                margin-bottom: 0
            }

            .invoice .contacts {
                margin-bottom: 20px
            }

            .invoice .invoice-to {
                text-align: left
            }

            .invoice .invoice-to .to {
                margin-top: 0;
                margin-bottom: 0
            }

            .invoice .invoice-details {
                text-align: right
            }

            .invoice .invoice-details .invoice-id {
                margin-top: 0;
                color: #3989c6
            }

            .invoice main {
                padding-bottom: 50px
            }

            .invoice main .thanks {
                margin-top: -100px;
                font-size: 2em;
                margin-bottom: 50px
            }

            .invoice main .notices {
                padding-left: 6px;
                border-left: 6px solid #3989c6
            }

            .invoice main .notices .notice {
                font-size: 1.2em
            }

            .invoice table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px
            }

            .invoice table td,.invoice table th {
                padding: 15px;
                background: #eee;
                border-bottom: 1px solid #fff
            }

            .invoice table th {
                white-space: nowrap;
                font-weight: 400;
                font-size: 16px
            }

            .invoice table td h3 {
                margin: 0;
                font-weight: 400;
                color: #3989c6;
                font-size: 1.2em
            }

            .invoice table .qty,.invoice table .total,.invoice table .unit {
                text-align: right;
                font-size: 1.2em
            }

            .invoice table .no {
                color: #fff;
                font-size: 1.6em;
                background: #3989c6
            }

            .invoice table .unit {
                background: #ddd
            }

            .invoice table .total {
                background: #3989c6;
                color: #fff
            }

            .invoice table tbody tr:last-child td {
                border: none
            }

            .invoice table tfoot td {
                background: 0 0;
                border-bottom: none;
                white-space: nowrap;
                text-align: right;
                padding: 10px 20px;
                font-size: 1.2em;
                border-top: 1px solid #aaa
            }

            .invoice table tfoot tr:first-child td {
                border-top: none
            }

            .invoice table tfoot tr:last-child td {
                color: #3989c6;
                font-size: 1.4em;
                border-top: 1px solid #3989c6
            }

            .invoice table tfoot tr td:first-child {
                border: none
            }

            .invoice footer {
                width: 100%;
                text-align: center;
                color: #777;
                border-top: 1px solid #aaa;
                padding: 8px 0
            }

            @media print {
                .invoice {
                    font-size: 11px!important;
                    overflow: hidden!important
                }

                .invoice footer {
                    position: absolute;
                    bottom: 10px;
                    page-break-after: always
                }

                .invoice>div:last-child {
                    page-break-before: always
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <img width="150px" src="images/logo.jpg" data-holder-rendered="true" />
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col-md-3 invoice-to">
                                    <h2 class="text-gray-light">立約人資料</h2>
                                    <div class="to">姓名：{{$user->name}}</h2>
                                    <div class="address">地址：台中市文心路一段332號</div>
                                    <div class="email">EMAIL：{{$user->email}}</div>
                                </div>
                                <div class="col-md-3 invoice-details">
                                    <div class="invoice-id">合約編號：{{strtotime($user->created_at).$user->id}}</div>
                                    <div class="data">契約簽署時間：{{date("Y-m-d",strtotime($user->created_at))}}</div>
                                    <div class="data">契約到期時間：{{date("Y-m-d", strtotime($user->created_at.'+1 year'))}}</div>
                                </div>
                            </div>
                            <div class="sites-layout-tile sites-tile-name-content-1"><p style="TEXT-ALIGN:center"><font size="4">合 作 契 約 書</font></p>
                                <p>立契約人達特民公司所有產品(Dr.Min淨白牙粉、初森之露口腔潔淨養護液)授權碼{{str_pad($user->id,5,'0',STR_PAD_LEFT)}}鄭景豪<br/>
                                    （以下簡稱甲方），茲指定{{$leader->name}}（以下簡稱乙方）作為銷售代理商，雙方議定下列條款，<br/>
                                    並同意遵守履行：</p>
<ol>
<li><strong>第一條</strong><br />甲方指定乙方銷售之達特民公司所有產品(Dr.Min淨白牙粉、初森之露口腔潔淨養<br/>
                                護液)（以下簡稱本產品），其詳細規格、配件明細等皆依附件所述。於乙方進貨產<br/>
                                品時所附贈贈品，不得銷售，違者罰款新台幣80000元並取消代理資格,停止供貨及<br/>
                                授權。另不可在販售「相關產品、類似產品、相同產品」等口腔內部清潔用品，違<br/>
                                者罰款新台幣580000元並取消代理資格，停止供貨及授權。</li>
<li><strong>第二條</strong><br />甲方販賣本產品與乙方之價格由「甲方定之」。乙方代理本產品販賣與第三人之價<br/>
                                格，除有特別約定外，應依甲方line群組之指示。甲方對於價格之指示若有變動，<br/>
                                於發布後三天內，方生拘束乙方之效力。以上價格不包括對本產品銷售於使用者後<br/>
                                之售後服務。</li>
<li><strong>第三條</strong><br />乙方應於向甲方訂購本產品後出貨或店到店取貨、或於前一日匯入甲方指定帳戶乙<br/>
                                方如有貨款未能給付時，甲方得逕行停止出貨予乙方並終止本契約。</li>
<li><strong>第四條</strong><br />乙方自通過甲方審核後，即為甲方之行銷商。但若乙方不願繼續擔任，或違反本契<br/>
                                約所訂之內容，則本契約之代理關係即時終止。代理間授權必須正式簽約，若無正<br/>
                                式簽約造成糾紛一律由上級代理負責賠償120000元新台幣並且提告。甲方乙方造成<br/>
                                糾紛須轉移上級代理一切由授權碼00001裁決決定，義務上以同線上級代理為準。</li>
<li><strong>第五條</strong><br />甲方授權之範圍僅限於甲方提供之本產品銷售廣告、說明等，乙方若欲自行製作任<br/>
                                何廣告或說明，應清楚標示為乙方自行製作且僅供參考，非甲方提供之正式說明等<br/>
                                字樣。乙方不得使用甲方之名義向第三人締結任何契約。乙方不得將本產品拆封、<br/>
                                改變包裝或分裝銷售。乙方應配合甲方之銷售策略與活動，並參加甲方指定之教育<br/>
                                訓練。乙方代理甲方之產品銷售方式，係以維護產品良好形象為基礎。其功能、規<br/>
                                格等非經甲方書面提出之內容範圍，不得自行製作任何媒體之誇大不實廣告或向客<br/>
                                戶允諾，亦不得宣稱本產品具有療效等違法行為。如因此造成甲方或第三者之損害<br/>
                                及侵權行為時，乙方應負一切損害賠償之責任。乙方應隨時注意甲方官方網站及line<br/>
                                群組之指示或公告，除有不可歸責之事由外，應依該指示或公告辦理。乙方行銷文<br/>
                                如未經過團隊當事人許可認同，不可複製他人宣傳文字。已傳到群組圖片相片有贈<br/>
                                送獎勵的分享文不在此限，但應盡禮貌，如發生糾紛一率由授權碼00001裁定處分。</li>
<li><strong>第六條</strong><br />甲方提供之本產品之規格、外觀、包裝如有不符或瑕疵，甲方無條件更換予乙方無<br/>
                                瑕疵之產品。每次出貨不得低於10盒。</li>
<li><strong>第七條</strong><br />未來若因世界原物料、國際環境、關稅、政治因素、成份優化配比、包裝升級等因<br/>
                                素，導致產品生產成本上漲，甲方將因漲價幅度謹慎評估做出調整，若確定調漲，<br/>
                                甲方應告知乙方漲價空間統一變動。</li>
<li><strong>第八條</strong><br />如因天災事變，或其他不可抗力事由，致甲方無法如期交貨或僅能交貨一部份，得延<br/>
                                緩至甲方恢復生產後10天工作日內交貨。生產時間周期為一個月整，此時間不包含海<br/>
                                運時間。如遇到進入安全庫存期限，乙方應配合甲方做分單、拆單、排單方式出貨，<br/>
                                使得產品正常銷售。</li>
<li><strong>第九條</strong><br />本契約終止或解除後，乙方應立即返還甲方授予之代理授權書，且不得再使用任何甲<br/>
                                方提供本產品之廣告、說明等素材。</li>
<li><strong>第十條</strong><br />若乙方違反本契約之任何內容，除甲方之實際損害外，應另外給付甲方新台幣三十萬<br/>
                                元之懲罰性違約金。若因乙方疏失導致甲方涉訟，甲方支出之費用(包括但不限被判決<br/>
                                命賠償數額、律師費、裁判費、交通費等)，亦應由乙方負擔。</li>
<li><strong>第十一條</strong><br />本契約之解釋、效力及其他未盡事宜，皆以相關法律為準則。倘有任何糾紛，雙方亦<br/>
                                應依誠實信用原則解決。如有訴訟必要，雙方同意以甲方居住地法院為第一審管轄法院。</li>
<li><strong>第十二條</strong> <br />未經任一方之事前書面同意，他方不得將本合約內容洩露予與履約無關之第三人。<br/>
                                與本授權契約有關之一切資料及文件，均屬機密文件，不得將該機密文件作為本契約目<br/>
                                的外之使用。</li>
<li><strong>第十三條</strong><br />本契約所附一切附件均為本契約之一部份，與本契約有同一效力。乙方按【同意】後<br/>
                                ，即表示受本契約及相關附件拘束。</li>
</ol>
<p>代理制度：<br />累計制，累計到40盒可升級黃金級代理，如下表：</p>
<table style="height: 156px;" width="357">
<tbody>
<tr style="height: 15px;">
<td style="width: 81px; height: 15px;">代理階級</td>
<td style="width: 82px; height: 15px;">盒數</td>
<td style="width: 83px; height: 15px;">牙粉批發價</td>
<td style="width: 83px; height: 15px;">養護液批發價</td>
</tr>
<tr style="height: 15px;">
<td style="width: 81px; height: 15px;">三星總經銷</td>
<td style="width: 82px; height: 15px;">2220</td>
<td style="width: 83px; height: 15px;">170</td>
<td style="width: 83px; height: 15px;">160</td>
</tr>
<tr style="height: 16px;">
<td style="width: 81px; height: 16px;">二星區顧問</td>
<td style="width: 82px; height: 16px;">780</td>
<td style="width: 83px; height: 16px;">190</td>
<td style="width: 83px; height: 16px;">180</td>
</tr>
<tr style="height: 16px;">
<td style="width: 81px; height: 16px;">一星級顧問</td>
<td style="width: 82px; height: 16px;">320</td>
<td style="width: 83px; height: 16px;">220</td>
<td style="width: 83px; height: 16px;">200</td>
</tr>
<tr style="height: 16px;">
<td style="width: 81px; height: 16px;">白金級顧問</td>
<td style="width: 82px; height: 16px;">120</td>
<td style="width: 83px; height: 16px;">270</td>
<td style="width: 83px; height: 16px;">220</td>
</tr>
<tr style="height: 16px;">
<td style="width: 81px; height: 16px;">黃金級顧問</td>
<td style="width: 82px; height: 16px;">40</td>
<td style="width: 83px; height: 16px;">300</td>
<td style="width: 83px; height: 16px;">240</td>
</tr>
<tr style="height: 16px;">
<td style="width: 81px; height: 16px;">尊榮級顧問</td>
<td style="width: 82px; height: 16px;">10</td>
<td style="width: 83px; height: 16px;">330</td>
<td style="width: 83px; height: 16px;">260</td>
</tr>
</tbody>
</table>
<p>採用累計不回歸制，例：
    <br />批發10盒淨白牙粉，公司簽約入顧問(批發價330元/盒)下次批發10盒累計批發為20盒<br/>
        (批發價330元/盒)。累計40盒將可升級黃金級顧問(批發價300元/盒)。一次叫貨制，例：<br/>
        一次性批發320盒，價錢直接由一星級顧問批發價(批發價220)計算，累積批發為320盒，不<br/>
        歸零累積盒數。口腔潔淨養護液同牙粉制度</p>
<p>現金返利：
    <br />成為三星總經銷業績重新歸零，以每月業績計算現金返利，出入貨窗口將直對公司，之<br/>
    後採取每月業績到達300盒以上將現金返利。當月300盒返利 3%。1000盒 返利 4%。2000盒返利5%。<br/>
    例：以3088盒為例，現金返利計算方式，3088*170*5%=26248元。口腔潔淨養護液同牙粉制度</p>
<p>三星同級薪水：<br />
    (A)三星總代理的下級代理商(B)也榮升為三星總代理，此(B)總代理若當月批貨量達<br/>
    300盒以上(未達300盒將無同級薪水)則公司當月將分紅(A)總代理4000元同級薪水。<br/>
    ex:若此三星總代理帶出3位三星總代理,每位達成批貨量300盒以上,則當月分紅12000分<br/>
    紅獎金以此類推口腔潔淨養護液同牙粉制度</p>
                            
                                <div class="col company-details">
                                    <h2 class="company">
                                        魔后美學
                                    </h2>
                                </div>
                        </main>
                        <footer>
                            <p>
                                優質的產品、完美的制度、最強的魔后。台灣醫美診所美齒權威-Dr.Min美齒專家 獨家產品
                                Dr.Min淨白牙粉 台灣獨家總經銷，台灣高科技Liposome胜肽微脂囊技術 保養品神話
                                童顏胜肽微脂囊緊緻精華
                            </p>
                        </footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>     
        </div>
    </body>
</html>
