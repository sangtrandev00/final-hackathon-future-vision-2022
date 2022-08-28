import React from 'react';
import PropTypes from 'prop-types';
import './chuongtrinhchitiet.css';
import Header from '../../components/Header/index';
import HeaderContact from '../../components/HeaderContact/index';
import Footer from '../../components/Footer/index';
import { useState, useEffect } from 'react';
import { useLocation, Link } from 'react-router-dom';
import { demo_project_backend } from '../../../../declarations/demo_project_backend';
import { sumMoney } from '../../utils/Common';
import DonorRow from './DonorRow/index';
import { calculateDaysLeft } from '../../utils/Common';

import { Principal } from '@dfinity/principal';
import { TokenDVision } from '../../../../declarations/TokenDVision/index';
DetailFundPage.propTypes = {};

// function calculateDaysLeft(DateEnd) {
//   const present_date = new Date();
//   const end_date = new Date(DateEnd);
//   var Difference_In_Time = end_date.getTime() - present_date.getTime();
//   var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
//   return Math.round(Difference_In_Days);
// }

function DetailFundPage(props) {
  const [fullDescHtml, setFullDesc] = useState('');
  // States of Token donate
  // const [currentMoneyDonate, setCurrentMoneyDonate] = useState(0);
  const [inputValue, setInput] = useState('');
  const [successToken, setSuccessToken] = useState('');
  const [balanceResult, setBalance] = useState('');
  const [cryptoSympol, setSympol] = useState('');
  console.log('cryptoSympol', cryptoSympol);
  const [isHidden, setIsHidden] = useState(true);
  const [isSuccessDonate, setIsSuccessDonate] = useState(false);

  // Full description
  const [fundProject, setFundProject] = useState({});
  const [donateFundList, setDonateList] = useState([]);

  const [currentMoneyDonate, setCurrentMoneyDonate] = useState(0);
  const [progressPercent, setProgressPercent] = useState(0);
  // console.log('currentMoneyDonate', currentMoneyDonate);
  const LinkUrlDisburseMentPage = `/disbursement-detail-page?name=${fundProject.ProjectID}`;
  const daysLeft = calculateDaysLeft(fundProject.DateEnd);
  // const daysLeft = -1; test quá hạn dự án !!!

  const ProjectParams = useLocation();

  const idFundProject = ProjectParams.search.substring(6);
  const LinkToDonationPhpPage = `https://fpolytuthien.com/pages/donate.php?id=${idFundProject}`;
  // const progressPercent = (currentMoneyDonate / fundProject.TargetMoney) * 100;

  const completeBtnStyle = {
    backgroundColor: progressPercent >= 100 && '#f26f21',
    color: progressPercent >= 100 && '#fff',
    cursor: progressPercent >= 100 && 'not-allowed',
  };

  useEffect(() => {
    async function showDetailFundProject() {
      const fundProjectObject = await demo_project_backend.view_fund_project(idFundProject);
      // console.log(fundProjectObject);
      // console.log(FundDonationObject[0]);
      const { TargetMoney } = fundProjectObject[0];
      const newFundProject = {
        ...fundProjectObject[0],
        TargetMoney: TargetMoney,
      };

      // console.log(fundProjectObject[0]);
      setFundProject(newFundProject);
      // console.log(newFundProject.FullDesc);
      document.querySelector('.detail-fund__body-full-detail-text').innerHTML =
        newFundProject.FullDesc;
      const donateListEntries = await demo_project_backend.readDonateInfo();
      let donateList = donateListEntries.map((donateList) => donateList[0]);
      // Lọc ra nhưng donate rỗng
      donateList = donateList.filter((donate) => donate != null);
      console.log('donateList: ', donateList);

      let sum = 0;
      const currentDonateList = [];
      donateList.forEach((donate) => {
        if (donate.FundProjectId == idFundProject) {
          sum += donate.DonateMoney;
          currentDonateList.push(donate);
        }
      });
      // const newMoney = sumMoney(fundProject.FundProjectId, donateList);
      setCurrentMoneyDonate(sum);

      const currentProgressPercent = (sum / Number(newFundProject.TargetMoney)) * 100;
      // console.log(currentMoneyDonate, Number(newFundProject.TargetMoney));
      // console.log('currentProgressPercent', currentProgressPercent);
      setProgressPercent(currentProgressPercent);
      setDonateList(currentDonateList);
    }

    // getCurrentMoney();
    showDetailFundProject();
  }, []);

  useEffect(() => {
    const donateByToken = async () => {
      // setIsHidden(true)
    };

    donateByToken();
  }, []);

  function handleChange(e) {
    console.log(e.target.value);
    setInput(e.target.value);
  }

  async function handleOnClick() {
    console.log('Balance Button Clicked');
    // setInput()
    const currentPrincipalIDText = await TokenDVision.getCurrentPrincipal();
    console.log('currentPrincipalIDtext', currentPrincipalIDText);
    const currentPrincipalID = Principal.fromText(currentPrincipalIDText);
    // const principal = Principal.fromText(inputValue);
    // console.log(principal);
    const balance = await TokenDVision.balanceOf(currentPrincipalID);
    console.log('balance', balance);

    const DonateFundToken = await TokenDVision.DonateFundToken(
      Number(idFundProject),
      Number(inputValue)
    );
    setSuccessToken(inputValue);

    console.log('DonateFundToken', DonateFundToken);
    console.log(await TokenDVision.sizeOfDonateTokenMaps());

    const currencyText = await TokenDVision.getSympol();
    console.log('currencyText', currencyText);

    const isSuccessDonate = DonateFundToken == 'sucess transfer' ? true : false;
    setIsSuccessDonate(isSuccessDonate);
    setSympol(currencyText);
    // console.log(typeof balance);
    setIsHidden(false);
    // setBalance(balance.toLocaleString()); // Formart Number on front end
  }

  return (
    <div className="detail-fund-page">
      <HeaderContact />
      <Header />
      <div class="container detail-fund__container">
        <div class="">
          <div class="">
            <h2 className="detail-fund__id">Mã dự án: {fundProject.ProjectID}</h2>
            <h3 class="detail-fund__name">Tên dự án :{fundProject.ProjectName}</h3>
            <h3 className="detail-fund__type-project">Loại dự án: {fundProject.ProjectType}</h3>
          </div>
          <div className="detail-fund__wrapper-body">
            <div class="detail-fund__body">
              <h4 class="detail-fund__body-short-desc">Mô tả ngắn:</h4>
              <p class="detail-fund__body-short-desc-text">{fundProject.ShortDesc}</p>
              <div class="detail-fund__body-full-img">
                <img src={fundProject.ImgUrl} alt="" />
                <p className="detail-fund__img-desc">Hình ảnh: {fundProject.ProjectName}</p>
              </div>
              <div class="detail-fund__body-full-detail">
                <div className="detail-fund__body-full-detail-text-wrapper">
                  <h3 className="detail-fund__body-full-detail-heading">Chi tiết thông tin:</h3>
                  <div
                    className="detail-fund__body-full-detail-text"
                    onChange={(e) => {
                      console.log('e.target', e.target);
                    }}
                  >
                    {fundProject.FullDesc}
                  </div>
                </div>

                <div class="detail-fund__body-full-detail-donor-list">
                  <h2>Các nhà hảo tâm đã đóng góp</h2>
                  <h3>Đóng góp bằng tiền VND</h3>
                  <ul>
                    {donateFundList.map((donate) => {
                      console.log('donateName: ', donate.Name);
                      console.log('donateMoney: ', donate.DonateMoney);
                      return (
                        <li key={donate.FundId}>
                          Cảm ơn Anh/Chị: {donate.Name} - đã góp: {donate.DonateMoney} VND
                        </li>
                      );
                    })}
                    {/* <li>Nguyễn Văn A - Đã góp 10 triệu - </li>
                    <li>Nguyễn Văn B - Đã góp 12 triệu - </li>
                    <li>Nguyễn Văn C - Đã góp 11 triệu - </li>
                    <li>Nguyễn Văn E - Đã góp 8 triệu - </li>
                    <li>Nguyễn Văn F - Đã góp 14 triệu - </li> */}
                  </ul>

                  <h3>Đóng góp bằng token DVision</h3>
                  {/* <ul></ul> */}
                </div>
              </div>
            </div>

            <div class="detail-fund__sidebar">
              <p>
                <span class="event_left">
                  <span>Ngày còn lại:</span>
                  <i class="material-icons"></i>
                  {daysLeft >= 0 ? (
                    <span className="day-left">{daysLeft} ngày</span>
                  ) : (
                    <span>Dự án đã kết thúc</span>
                  )}
                </span>
              </p>
              <p>
                <span class="event_right">
                  {/* Location thêm vào */}
                  <span>Địa điểm:</span>
                  <i class="material-icons"></i>
                  {fundProject.Location}
                </span>
              </p>
              <div class="progress-text">
                <h3 class="progress-text__heading">Tiến độ dự án: </h3>
                <p class="progress-top">{progressPercent.toFixed(2)}%</p>
                <div class="progress">
                  <div
                    class={progressPercent >= 100 ? 'progress-bar completed' : 'progress-bar'}
                    role="progressbar"
                    aria-valuenow={fundProject.CurrentMoney}
                    aria-valuemin="0"
                    aria-valuemax={fundProject.TargetMoney}
                    style={{ width: `${progressPercent}%` }}
                  ></div>
                </div>
                <p class="progress-left">
                  Đã góp: <span>{currentMoneyDonate.toLocaleString()}</span>
                </p>
                <p class="progress-right">
                  Mục tiêu: <span>{fundProject.TargetMoney}</span>
                </p>
              </div>
              <h2 class="borderes">
                <a
                  className={
                    progressPercent >= 100
                      ? 'fund-detail-page__donate-btn completed'
                      : 'fund-detail-page__donate-btn'
                  }
                  onClick={(e) => {
                    progressPercent >= 100 && e.preventDefault();
                  }}
                  style={completeBtnStyle}
                  href={progressPercent >= 100 ? '/fund-detail-page' : LinkToDonationPhpPage}
                >
                  {(daysLeft < 0 && 'Đã Quá Hạn') ||
                    (progressPercent > 100 ? 'ĐÃ ĐÓNG GÓP' : 'ĐÓNG GÓP VNPAY')}
                </a>

                {/* Donate by Token Input */}
                <div className="borderes donate_place">
                  <button className="donate_token_btn" onClick={handleOnClick}>
                    Đóng góp bằng Token
                  </button>
                  <input
                    className="donate_input"
                    type="text"
                    onChange={handleChange}
                    placeholder="Nhập số token ... DVision"
                    value={inputValue}
                  ></input>
                </div>
                <p hidden={isHidden} className="donate-input-text-status">
                  {isSuccessDonate
                    ? `Đã đóng góp ${successToken} ${cryptoSympol} vào dự án có ID = ${idFundProject}`
                    : 'Tài khoản không đủ token để đóng góp'}
                </p>

                {/* End Donate by Token Input */}
              </h2>
              <div class="finance">
                <h2 class="finance-title">BÁO CÁO TÀI CHÍNH</h2>
                <div class="finance-title__desc">
                  {/*  */}

                  <Link to="/search-page">* Kiểm tra đóng góp</Link>
                </div>
                <div class="finance-title__desc">
                  <Link to={LinkUrlDisburseMentPage}>* Kiểm tra giải ngân</Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="clear"></div>

      <Footer />
    </div>
  );
}

export default DetailFundPage;
