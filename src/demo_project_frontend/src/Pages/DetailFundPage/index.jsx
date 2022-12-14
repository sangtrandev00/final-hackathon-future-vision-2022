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
  // const daysLeft = -1; test qu?? h???n d??? ??n !!!

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
      // L???c ra nh??ng donate r???ng
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
            <h2 className="detail-fund__id">M?? d??? ??n: {fundProject.ProjectID}</h2>
            <h3 class="detail-fund__name">T??n d??? ??n :{fundProject.ProjectName}</h3>
            <h3 className="detail-fund__type-project">Lo???i d??? ??n: {fundProject.ProjectType}</h3>
          </div>
          <div className="detail-fund__wrapper-body">
            <div class="detail-fund__body">
              <h4 class="detail-fund__body-short-desc">M?? t??? ng???n:</h4>
              <p class="detail-fund__body-short-desc-text">{fundProject.ShortDesc}</p>
              <div class="detail-fund__body-full-img">
                <img src={fundProject.ImgUrl} alt="" />
                <p className="detail-fund__img-desc">H??nh ???nh: {fundProject.ProjectName}</p>
              </div>
              <div class="detail-fund__body-full-detail">
                <div className="detail-fund__body-full-detail-text-wrapper">
                  <h3 className="detail-fund__body-full-detail-heading">Chi ti???t th??ng tin:</h3>
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
                  <h2>C??c nh?? h???o t??m ???? ????ng g??p</h2>
                  <h3>????ng g??p b???ng ti???n VND</h3>
                  <ul>
                    {donateFundList.map((donate) => {
                      console.log('donateName: ', donate.Name);
                      console.log('donateMoney: ', donate.DonateMoney);
                      return (
                        <li key={donate.FundId}>
                          C???m ??n Anh/Ch???: {donate.Name} - ???? g??p: {donate.DonateMoney} VND
                        </li>
                      );
                    })}
                    {/* <li>Nguy???n V??n A - ???? g??p 10 tri???u - </li>
                    <li>Nguy???n V??n B - ???? g??p 12 tri???u - </li>
                    <li>Nguy???n V??n C - ???? g??p 11 tri???u - </li>
                    <li>Nguy???n V??n E - ???? g??p 8 tri???u - </li>
                    <li>Nguy???n V??n F - ???? g??p 14 tri???u - </li> */}
                  </ul>

                  <h3>????ng g??p b???ng token DVision</h3>
                  {/* <ul></ul> */}
                </div>
              </div>
            </div>

            <div class="detail-fund__sidebar">
              <p>
                <span class="event_left">
                  <span>Ng??y c??n l???i:</span>
                  <i class="material-icons"></i>
                  {daysLeft >= 0 ? (
                    <span className="day-left">{daysLeft} ng??y</span>
                  ) : (
                    <span>D??? ??n ???? k???t th??c</span>
                  )}
                </span>
              </p>
              <p>
                <span class="event_right">
                  {/* Location th??m v??o */}
                  <span>?????a ??i???m:</span>
                  <i class="material-icons"></i>
                  {fundProject.Location}
                </span>
              </p>
              <div class="progress-text">
                <h3 class="progress-text__heading">Ti???n ????? d??? ??n: </h3>
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
                  ???? g??p: <span>{currentMoneyDonate.toLocaleString()}</span>
                </p>
                <p class="progress-right">
                  M???c ti??u: <span>{fundProject.TargetMoney}</span>
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
                  {(daysLeft < 0 && '???? Qu?? H???n') ||
                    (progressPercent > 100 ? '???? ????NG G??P' : '????NG G??P VNPAY')}
                </a>

                {/* Donate by Token Input */}
                <div className="borderes donate_place">
                  <button className="donate_token_btn" onClick={handleOnClick}>
                    ????ng g??p b???ng Token
                  </button>
                  <input
                    className="donate_input"
                    type="text"
                    onChange={handleChange}
                    placeholder="Nh???p s??? token ... DVision"
                    value={inputValue}
                  ></input>
                </div>
                <p hidden={isHidden} className="donate-input-text-status">
                  {isSuccessDonate
                    ? `???? ????ng g??p ${successToken} ${cryptoSympol} v??o d??? ??n c?? ID = ${idFundProject}`
                    : 'T??i kho???n kh??ng ????? token ????? ????ng g??p'}
                </p>

                {/* End Donate by Token Input */}
              </h2>
              <div class="finance">
                <h2 class="finance-title">B??O C??O T??I CH??NH</h2>
                <div class="finance-title__desc">
                  {/*  */}

                  <Link to="/search-page">* Ki???m tra ????ng g??p</Link>
                </div>
                <div class="finance-title__desc">
                  <Link to={LinkUrlDisburseMentPage}>* Ki???m tra gi???i ng??n</Link>
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
