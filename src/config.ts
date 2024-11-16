const examChaptersEP     = `${mpMetDat.rbUrl}${mpMetDat.rNamespace}exam/chapters`;
const singleChapterEP    = `${mpMetDat.rbUrl}${mpMetDat.rNamespace}exam/chapter`;
const userSupervisorEP   = `${mpMetDat.rbUrl}${mpMetDat.rNamespace}user/supervisor`;
const userRegistrationEP = `${mpMetDat.rbUrl}${mpMetDat.rNamespace}user/register`;
const userLoginEP        = `${mpMetDat.rbUrl}${mpMetDat.rNamespace}user/login`;
const newsletterLeadEP      = `${mpMetDat.rbUrl}${mpMetDat.rNamespace}lead-generation/newsletter`;

export {
    examChaptersEP,
    singleChapterEP,
    userSupervisorEP,
    userRegistrationEP,
    userLoginEP,
    newsletterLeadEP
}

console.log(examChaptersEP);