import React, { useState, useEffect } from 'react';
import PropTypes from 'prop-types';
import Header from '../../components/Header';
import Footer from '../../components/Footer';
import HeaderContact from '../../components/HeaderContact';
import fundDonateApi from '../../api/fundDonateApi';
import { demo_project_backend } from '../../../../declarations/demo_project_backend/index';

DonationPage.propTypes = {};

function DonationPage(props) {
  // const [donation, setDonation] = useState({
  //   covid_project_list: [],
  //   living_project_list: [],
  //   cheapfood_project_list: [],
  //   poor_project_list: [],
  // });

  //   const [projectList, setProjectList] = useState([]);

  // useEffect(() => {
  //   const fetchDonations = async () => {
  //     const fundDonates = await fundDonateApi.getAll();
  //     console.log(fundDonates.list_donate);

  //     const donationList = fundDonates.list_donate;
  //     donationList.forEach((donation) => {
  //       const createDonation = async () => {
  //         await demo_project_backend.createDonation(
  //           donation.FundDonateId,
  //           donation.NameDonor,
  //           donation.Email,
  //           donation.Phone,
  //           20000000,
  //           donation.NameProject,
  //           donation.Message,
  //           donation.TimeDonate,
  //           donation.FundProjectId,
  //           donation.TypeProject
  //         );
  //       };
  //       createDonation();
  //     });

  //     // const covid_project_list = cateProjects.category_1;
  //     // const living_project_list = cateProjects.category_2;
  //     // const cheapfood_project_list = cateProjects.category_3;
  //     // const poor_project_list = cateProjects.category_4;
  //     // setProjects({
  //     //   covid_project_list: covid_project_list,
  //     //   living_project_list: living_project_list,
  //     //   cheapfood_project_list: cheapfood_project_list,
  //     //   poor_project_list: poor_project_list,
  //     // });
  //   };

  //   fetchDonations();
  // }, []);

  return (
    <div className="donation-page">
      {/* Header */}
      <HeaderContact />
      <Header />
      <section class="donors">
        <div class="container">
          <div class="row">
            <div class="col-md-12 ">
              <div class="donors_input col-md-6 ">
                <h2 class="donors-input-title">????NG G??P</h2>
                <form class="donors-input-form" action="#" method="post">
                  <div class="donors-input-form__infor">
                    {/* Name input */}
                    <input class="donors-input-form__infor-desc" type="text" placeholder="T??n" />
                    {/* Email Input */}
                    <input class="donors-input-form__infor-desc" type="email" placeholder="Email" />
                    {/* Phone input */}
                    <input
                      class="donors-input-form__infor-desc"
                      type="text"
                      placeholder="S??? ??i???n tho???i"
                    />
                    {/* Donate Money */}
                    <input
                      class="donors-input-form__infor-desc"
                      type="text"
                      placeholder="S??? ti???n ????ng g??p"
                    />
                  </div>
                  {/* Name Donate Project */}
                  <div class="donors-input-form__option">
                    <select class="donors-input-form__option-desc">
                      <option>T??i mu???n ????ng g??p cho d??? ??n 1</option>
                      <option>T??i mu???n ????ng g??p cho d??? ??n 2</option>
                      <option>T??i mu???n ????ng g??p cho d??? ??n 3</option>
                    </select>

                    <div class="donors-input-form__option">
                      <select class="donors-input-form__option-desc" name="" id="">
                        <option value="">Chuy???n ti???n online</option>
                        <option value="">????ng g??p b???ng v??</option>
                      </select>
                    </div>

                    {/* Message Donate */}
                    <div class="donors-input-form__note">
                      <textarea
                        class="donors-input-form__note-desc"
                        type="text"
                        placeholder="L???i nh???n"
                      ></textarea>
                    </div>
                  </div>

                  <a class="donors-input-form__done" href="#">
                    <input
                      class="donors-input-form__done-desc"
                      type="submit"
                      value="????NG G??P B???NG VNPAY"
                    />
                  </a>
                </form>
              </div>

              <div class="donors-output col-md-6 ">
                <div class="donors-output-head">
                  <div class="donors-output-head__title">L???CH S??? GIAO D???CH</div>
                  <a href="search-page.html" class="donors-output-head__link">
                    <button class="donors-output-head__link-btn">KI???M TRA ????NG G??P</button>
                  </a>
                </div>
                <div class="donors-output-container">
                  <table class="donors-output-container__body">
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">M?? giao d???ch</td>
                      <td class="colum2">Th???i gian</td>
                      <td class="colum3">S??? ti???n</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                    <tr class="donors-output-container__body-title">
                      <td class="colum1">
                        <a href="">hd3ehd932hd832hd93ye3d...</a>
                      </td>
                      <td class="colum2">12:30</td>
                      <td class="colum3">300.000</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <Footer />
    </div>
  );
}

export default DonationPage;
