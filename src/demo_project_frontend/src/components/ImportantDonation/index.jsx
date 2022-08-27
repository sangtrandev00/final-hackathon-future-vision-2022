import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import PropTypes from 'prop-types';
import ImportantImg_1 from '../../../assets/img/img-ctrinh/ctrinh-quantrong/hinh-1.jpeg';
import { demo_project_backend } from '../../../../declarations/demo_project_backend/index';
ImportantDonation.propTypes = {};

function ImportantDonation(props) {
  const [importantProject, setImportantProject] = useState({});
  const { currentProgress, setCurrentProgress } = useState();
  const LinkUrlToDetailFundPage = `/fund-detail-page?name=${importantProject.ProjectID}`;
  console.log(importantProject);
  useEffect(() => {
    const getImportantProject = async () => {
      const importantProject = await demo_project_backend.view_fund_project('1');
      console.log('importantProject', importantProject[0]);
      setImportantProject(importantProject[0]);

      const currentProgress = importantProject[0].CurrentMoney / importantProject[0].TargetMoneyy;
      setCurrentProgress(currentProgress);
    };

    getImportantProject();
  }, []);

  return (
    <div>
      <section class="donate_section">
        <div class="container">
          <div class="row">
            <div class="col-md-7 for-padding">
              <img src={importantProject.ImgUrl} alt="important image" />
            </div>
            <div class="col-md-5 for-padding">
              <h4>DỰ ÁN QUAN TRỌNG</h4>
              <h3>{importantProject.ProjectName}</h3>
              <p>{importantProject.ShortDesc}</p>
              <div class="progress-text">
                <p class="progress-top">{currentProgress}%</p>
                <div class="progress">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    aria-valuenow="70"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    style={{ width: `${currentProgress}%` }}
                  ></div>
                </div>
                <p class="progress-left">Đã góp: {importantProject.CurrentMoney}</p>
                <p class="progress-right">Mục tiêu: {importantProject.TargetMoneyy}</p>
              </div>
              <h2>
                <Link to={LinkUrlToDetailFundPage}>ĐÓNG GÓP NGAY</Link>
              </h2>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}

export default ImportantDonation;
