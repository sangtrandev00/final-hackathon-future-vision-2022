import '../assets/css/styles/common.css';
import '../assets/css/styles/column.css';
import '../assets/css/styles/grid.css';
import '../assets/css/styles/grid-donggop.css';
import '../assets/css/styles/modal.css';
import '../assets/css/styles/progressbar.css';
import '../assets/css/styles/reponsive-nav.css';
import '../assets/css/styles/responsive.css';

import '../assets/css/styles/search-page.css';
import '../assets/css/styles/style-chuongtrinh.css';
import '../assets/css/styles/style-index.css';
import '../assets/css/styles/style-ctrchitiet.css';
import '../assets/css/styles/style-baocaotaichinh.css';
import '../assets/css/styles/style-gioithieu.css';
import '../assets/css/styles/style-donggop.css';
import '../assets/css/styles/detail-donate-page.css';
import '../assets/css/styles/style.css';
import Banner from './components/Banner';
import HeaderContact from './components/HeaderContact';
import ImportantDonation from './components/ImportantDonation';
import LastestNews from './components/LastestNews';
import HomePage from './Pages/HomePage';
import { Link, Route, Switch } from 'react-router-dom';
import IntroPage from './Pages/IntroPage';
import ProgramsfundPage from './Pages/FundProgramsPage';
import DonationPage from './Pages/DonationPage';
import SearchPage from './Pages/SearchPage';
import NotFound from './components/NotFound';
import React from 'react';
import HistoryDonatePage from './Pages/HistoryDonatePage';
import DetailFundPage from './Pages/DetailFundPage';
import DisbursementPage from './Pages/DisbursementPage';
import { useEffect } from 'react';
import projectApi from './api/projectApi';
import NewDonationPage from './Pages/NewTransaction/index';
import CovidProjectPage from './Pages/FundProgramsPage/components/CovidProjectPage/index';
import PoorProjectPage from './Pages/FundProgramsPage/components/PoorProjectPage/index';
import HomeLessProjectPage from './Pages/FundProgramsPage/components/HomeLessProjectPage/index';
import EducationProjectPage from './Pages/FundProgramsPage/components/EducationProjectPage/index';
import NewProjectPage from './Pages/NewProjectPage/index';
import NewDisbursementPage from './Pages/NewDisbursementPage/index';
import NewTransaction from './Pages/NewTransaction/index';
import { TokenDVision } from '../../declarations/TokenDVision/index';

// import "./assets/css/style.css";
// import "./assets/css/style.css";
// import "./assets/css/style.css";

function App() {
  useEffect(() => {
    async function hardUpdate() {
      const walletid = await window.ic?.plug?.requestConnect();
      console.log(walletid);
      const walletUser = window.ic.plug.principalId;
      console.log(walletUser);
      await TokenDVision.instantiate(walletUser);
      document.getElementById('principal-id').innerText = walletUser;
      console.log(walletUser);
    }

    hardUpdate();
  }, []);

  return (
    <div className="App">
      <div className="wrapper">
        <Switch>
          <Route path="/introduction-page" component={IntroPage} />
          <Route path="/programs-fund-page" component={ProgramsfundPage} />
          <Route path="/covid-project-fund" component={CovidProjectPage} />
          <Route path="/new-transtraction-page" component={NewTransaction} exact={false} />
          {/* <Route path="/new-project-page" component={NewProjectPage} exact={false} />
          <Route path="/new-disbursement-page" component={NewDisbursementPage} exact={false} /> */}
          <Route path="/education-project-fund" component={EducationProjectPage} />
          <Route path="/homeless-project-fund" component={HomeLessProjectPage} />
          <Route path="/poor-project-fund" component={PoorProjectPage} />
          <Route path="/donation-page" component={DonationPage} />
          <Route path="/search-page" component={SearchPage} />
          <Route path="/history-donate-page" component={DetailFundPage} />
          <Route path="/history-detail-donation-page" component={HistoryDonatePage} />
          <Route path="/disbursement-detail-page" component={DisbursementPage} />
          <Route path="/fund-detail-page" component={DetailFundPage} />
          <Route path="/" component={HomePage} />
          {/* <Route component={NotFound} /> */}
        </Switch>
        {/* <HistoryDonatePage /> */}
      </div>
    </div>
  );
}

export default App;
