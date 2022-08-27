import React, { useEffect, useState } from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import { calculateDaysLeft } from '../../utils/Common';
import { demo_project_backend } from '../../../../declarations/demo_project_backend';
import './FundProjectItem.css';
import { demo_project_frontend } from '../../../../declarations/demo_project_frontend/index';
FundProjectItem.propTypes = {};

function FundProjectItem(props) {
  const [currentMoneyDonate, setCurrentMoneyDonate] = useState(0);
  const {
    ProjectID,
    Avatar,
    ProjectName,
    ProjectType,
    ShortDesc,
    FullDesc,
    DateStart,
    DateEnd,
    CurrentDonate,
    TargetMoney,
    Location,
  } = props;
  const LinkUrlToDetailFundPage = `/fund-detail-page?name=${ProjectID}`;
  console.log('ProjectID: ', ProjectID);
  const progressPercent = (currentMoneyDonate / TargetMoney) * 100;

  const completeBtnStyle = {
    backgroundColor: progressPercent >= 100 && '#f26f21',
    color: progressPercent >= 100 && '#fff',
    cursor: progressPercent >= 100 && 'not-allowed',
  };

  const LinkToDonationPhpPage = `https://fpolytuthien.com/pages/donate.php?id=${ProjectID}`;

  const dayLeft = calculateDaysLeft(DateEnd);

  useEffect(() => {
    const getCurrentMoney = async () => {
      const donateListEntries = await demo_project_backend.readDonateInfo();
      let donateList = donateListEntries.map((donateList) => donateList[0]);
      // Lọc ra nhưng donate rỗng
      donateList = donateList.filter((donate) => donate != null);
      let sum = 0;
      donateList.forEach((donate) => {
        // console.log('donate.FundProjectId: ', donate.FundProjectId);
        if (donate.FundProjectId == ProjectID) {
          sum += donate.DonateMoney;
        }
      });
      console.log('current donate: ', sum, 'type of currentDonate: ', typeof sum);
      //Update CurrentTarget Money
      console.log('Tạo dự án lần 2 --> Update currentMoney into canister backend');
      await demo_project_backend.createFundProject(
        ProjectID,
        ProjectName,
        ProjectType,
        DateStart,
        DateEnd,
        Number(sum),
        Number(TargetMoney),
        Avatar,
        Location, // Location from API
        ShortDesc,
        FullDesc
      );
      setCurrentMoneyDonate(sum);
      // console.log(await demo_project_backend.read);
    };
    getCurrentMoney();
  });

  return (
    <div class="col-md-4 col-xs-12 fund-item-wrap">
      <div class="item">
        <img src={Avatar} alt="error-img" />
        <div class="for_padding">
          <Link to={LinkUrlToDetailFundPage} class="name_event">
            Kỳ {ProjectID} : {ProjectName}
          </Link>
          <p>
            <span class="event_left">
              <i class="material-icons">access_time</i>
              {dayLeft} ngày
            </span>
            <p></p>
            <span class="event_right">
              <i class="material-icons">location_on</i>
              {/* Thiếu location ở đây */}
              {Location}
            </span>
          </p>
          <p class="describe_event">{ShortDesc} </p>
          <div class="progress-text">
            <p class="progress-top">{progressPercent.toFixed(2)}%</p>
            <div class="progress">
              <div
                class="progress-bar"
                role="progressbar"
                aria-valuenow={CurrentDonate}
                aria-valuemin="0"
                aria-valuemax={TargetMoney}
                style={{ width: `${progressPercent}%` }}
              ></div>
            </div>
            <p class="progress-left">
              Đã góp: <span>{currentMoneyDonate}</span>
            </p>
            <p class="progress-right">
              Mục tiêu: <span>{TargetMoney}</span>
            </p>
          </div>
          <h2 class="borderes">
            <a
              href={LinkToDonationPhpPage}
              onClick={(e) => {
                progressPercent >= 100 && e.preventDefault();
              }}
              style={completeBtnStyle}
              to={progressPercent >= 100 ? '/' : '/donation-page'}
            >
              {progressPercent >= 100 ? 'ĐÃ HOÀN THÀNH' : 'ĐÓNG GÓP NGAY'}
            </a>
          </h2>
          <div className="borderes">
            <button className="donate_token_btn">Donate By Token </button>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  );
}

export default FundProjectItem;
